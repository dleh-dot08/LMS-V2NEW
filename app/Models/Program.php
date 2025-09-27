<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $table = 'programs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'meta',
    ];

    // Pastikan slug unik
    public static function boot()
    {
        parent::boot();

        static::creating(function ($program) {
            if (static::where('slug', $program->slug)->exists()) {
                throw new \Exception("Slug '{$program->slug}' sudah digunakan.");
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(ProgramCategory::class, 'category_id');
    }
}
