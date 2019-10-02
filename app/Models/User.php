<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Job;
use App\Models\Employer;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'linkedin_id', 'linkedin_name', 'linkedin_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * The jobs that belong to the user.
     */
    public function savedJobs()
    {
        return $this->belongsToMany('App\Models\Job', 'saved_jobs', 'user_id', 'job_id');
    }

    public function hasSavedJobs($job)
    {
        return $this->savedJobs->contains($job->id);
    }

    public function employer()
    {
        return $this->hasOne('App\Models\Employer');
    }

    public function employee()
    {
        return $this->hasOne('App\Models\Employee');
    }
}
