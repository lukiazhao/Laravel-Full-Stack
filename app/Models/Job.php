<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function classifications()
    {
        return $this->belongsToMany('App\Models\Classification');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function employer()
    {
        return $this->belongsTo('App\Models\Employer');
    }

    public function applications()
    {
        return $this->hasMany('App\Models\Application');
    }
}
