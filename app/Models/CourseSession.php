<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSession extends Model
{
    protected $table = 'course_sessions'; // important
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function mentors()
    {
        // session_mentors table
        return $this->belongsToMany(User::class, 'session_mentors', 'session_id', 'user_id')
                    ->withPivot('is_primary','assigned_at')
                    ->withTimestamps();
    }

    public function journals()
    {
        return $this->hasMany(Journal::class, 'session_id');
    }

    public function attendanceSessions()
    {
        return $this->hasMany(AttendanceSession::class, 'session_id');
    }
}
