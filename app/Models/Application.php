<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }

    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }
}
