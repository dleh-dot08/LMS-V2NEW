<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassGroup extends Model
{
    use HasFactory;

    protected $table = 'class_groups';
    protected $primaryKey = 'id';

    protected $fillable = [
        'school_id',
        'name',
        'grade_label',
        'academic_year',
        'capacity',
        'meta',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    // Validasi kombinasi unik (school_id + academic_year + name)
    public static function boot()
    {
        parent::boot();

        static::creating(function ($classGroup) {
            if (static::where('school_id', $classGroup->school_id)
                ->where('academic_year', $classGroup->academic_year)
                ->where('name', $classGroup->name)
                ->exists()
            ) {
                throw new \Exception("Class Group dengan nama '{$classGroup->name}' untuk tahun akademik '{$classGroup->academic_year}' sudah ada di sekolah ini.");
            }
        });
    }
}
