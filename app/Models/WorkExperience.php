<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    public $fillable = [
        'employee_id',
    ];
    
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }
}
