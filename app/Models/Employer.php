<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Employer extends Model
{
    public $fillable = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function jobs()
    {
        return $this->hasMany('App\Models\Job');
    }

    public function classification()
    {
        return $this->belongsTo('App\Models\Classification');
    }

    public function company_size()
    {
        return $this->belongsTo('App\Models\CompanySize');
    }

    public function getCompanyLogoAttribute($value)
    {
        if (!$value) {
            return null;
        }
        return Storage::disk('s3')->url($value);
    }
}
