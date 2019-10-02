<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Employee extends Model
{
    public $fillable = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function workExperiences()
    {
        return $this->hasMany('App\Models\WorkExperience');
    }

    public function applications()
    {
        return $this->hasMany('App\Models\Application');
    }

    public function hasAppliedJobs($job)
    {
        return $this->applications->where('job_id', $job->id)->first();
    }

    public function getResumePathAttribute($value)
    {
        if (!$value) {
            return null;
        }
        return Storage::disk('s3')->url($value);
    }
}
