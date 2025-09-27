<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramCategory extends Model
{
    use HasFactory;

    protected $table = 'program_categories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'meta',
    ];

    public function programs()
    {
        return $this->hasMany(Program::class, 'category_id');
    }
}
