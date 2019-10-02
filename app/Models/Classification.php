<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    public function jobs()
    {
        return $this->belongsToMany('App\Models\Job');
    }

    public function employers()
    {
        return $this->hasMany('App\Models\Employer');
    }
}
