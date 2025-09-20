<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function menu()
    {
        $menus = config('menu');
        return $menus[$this->role_id] ?? [];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Role::class, 'role_id');
    }

    // accessor: $user->role_name
    public function getRoleNameAttribute(): ?string
    {
        // kalau ada relasi roles, ambil nama; kalau tidak, fallback null
        return $this->role ? $this->role->name : null;
    }

    // courses where user is assigned as mentor (via course_mentors)
    public function coursesMentored()
    {
        return $this->belongsToMany(Course::class, 'course_mentors', 'user_id', 'course_id')
                    ->withTimestamps()
                    ->withPivot('role_in_course');
    }

    // session mentor assignments (session_mentors)
    public function sessionMentorAssignments()
    {
        return $this->hasMany(SessionMentor::class, 'user_id'); // optional helper model
    }

    // enrollments (as learner)
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'user_id');
    }

    // quick role helper
    public function isRole($idOrName)
    {
        if (is_numeric($idOrName)) return $this->role_id == (int)$idOrName;
        return optional($this->role)->name === $idOrName;
    }


}
