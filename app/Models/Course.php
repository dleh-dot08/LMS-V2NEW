<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function mentors()
    {
        // course_mentors pivot
        return $this->belongsToMany(User::class, 'course_mentors', 'course_id', 'user_id')
                    ->withPivot('role_in_course','assigned_at')
                    ->withTimestamps();
    }

    public function modules()
    {
        return $this->hasMany(Module::class, 'course_id');
    }

    public function materials()
    {
        return $this->hasMany(Material::class, 'course_id');
    }

    public function sessions()
    {
        return $this->hasMany(CourseSession::class, 'course_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'course_id');
    }

    public function certificates()
    {
        return $this->hasMany(UserCertificate::class, 'course_id');
    }

    // helper to check active by date / locked
    public function getIsActiveAttribute()
    {
        if ($this->is_locked) return false;
        if ($this->start_date && now()->lt($this->start_date)) return false;
        if ($this->end_date && now()->gt($this->end_date)) return false;
        return true;
    }
}
