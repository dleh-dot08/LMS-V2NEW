<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $guarded = [];

    public function classGroups()
    {
        return $this->hasMany(ClassGroup::class, 'school_id');
    }

    public function partners() // alias
    {
        return $this->hasMany(User::class, 'partner_school_id');
    }
}
