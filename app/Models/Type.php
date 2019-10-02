<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

    /**
     * Get the jobs for the Job Type.
     */
    public function jobs()
    {
        return $this->hasMany('App\Models\Job');
    }
}
