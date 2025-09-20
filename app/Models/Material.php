<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    // helpful accessor to detect external link types
    public function getIsExternalAttribute()
    {
        return filled($this->url);
    }
}
