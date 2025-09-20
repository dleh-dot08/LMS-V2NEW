<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\School;
use App\Models\Enrollment;
use App\Models\Session as CourseSession;
use App\Models\Assignment;
use App\Models\Material;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // role id: 1 superadmin, 2 admin, 3 mentor, 4 learner, 5 partner, 6 pic
        $role = (int) $user->role_id;

        // default metrics
        $metrics = [
            'users' => 0,
            'courses' => 0,
            'partners' => 0,
            'students' => 0,
            'lecturers' => 0,
            'my_courses' => 0,
            'sessions_today' => 0,
            'assignments' => 0,
            'attendance_percent' => 0,
            'materials' => 0,
            'schools' => 0,
            'reports' => 0,
        ];

        // populate metrics for Superadmin (global)
        if ($role === 1) {
            $metrics['users'] = User::count();
            $metrics['courses'] = Course::count();
            $metrics['partners'] = School::count(); // treat partners as schools
        }

        // Admin (operational) metrics
        if ($role === 2) {
            $metrics['students'] = User::where('role_id', 4)->count(); // learners
            $metrics['lecturers'] = User::where('role_id', 3)->count(); // mentors
            $metrics['courses'] = Course::count();
        }

        // Mentor metrics (courses they mentor, sessions today, student count across their courses)
        if ($role === 3) {
            $metrics['my_courses'] = Course::whereHas('mentors', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->count();

            $today = Carbon::today();
            $metrics['sessions_today'] = CourseSession::whereDate('session_date', $today)
                ->whereHas('course', function($q) use ($user) {
                    $q->whereHas('mentors', fn($q2) => $q2->where('user_id', $user->id));
                })->count();

            // unique students across mentor courses (simple approach)
            $metrics['students'] = Enrollment::whereHas('course', function($q) use ($user) {
                $q->whereHas('mentors', fn($q2) => $q2->where('user_id', $user->id));
            })->distinct('user_id')->count('user_id');
        }

        // Learner metrics (my courses, pending assignments, attendance%)
        if ($role === 4) {
            $metrics['my_courses'] = Enrollment::where('user_id', $user->id)->count();
            $metrics['assignments'] = Assignment::whereHas('course', function($q) use ($user) {
                $q->whereHas('enrollments', fn($q2) => $q2->where('user_id', $user->id));
            })->count();
            // Attendance percent - example: (attended / total) * 100
            // assume you have AttendanceRecord model; adapt as needed
            try {
                $total = \DB::table('attendance_records')
                    ->where('student_user_id', $user->id)->count();
                $attended = \DB::table('attendance_records')
                    ->where('student_user_id', $user->id)
                    ->where('status', 'present')->count();
                $metrics['attendance_percent'] = $total ? round($attended / $total * 100) : 0;
            } catch (\Exception $e) {
                $metrics['attendance_percent'] = 0;
            }
        }

        // Partner (school) metrics
        if ($role === 5) {
            // assume partner user has partner_school_id
            $schoolId = $user->partner_school_id;
            $metrics['courses'] = Course::where('meta->partner_school_id', $schoolId)->count() ?? 0;
            $metrics['schools'] = School::count();
            $metrics['students'] = \DB::table('class_students')->where('school_id', $schoolId)->count();
        }

        // PIC (school PIC) metrics
        if ($role === 6) {
            $schoolId = $user->partner_school_id;
            $metrics['materials'] = Material::whereHas('course', function($q) use ($schoolId) {
                $q->whereJsonContains('meta->partner_school_id', $schoolId);
            })->count();
            $metrics['students'] = \DB::table('class_students')->where('class_group_id', $user->current_class_group_id)->count();
            $metrics['reports'] = \DB::table('report_exports')->where('generated_by', $user->id)->count();
        }

        // return view
        return view('dashboard', compact('role', 'metrics'));
    }
}
