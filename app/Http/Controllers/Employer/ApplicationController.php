<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function index()
    {
        $jobs = Auth::user()->employer->jobs;
        $job_array = [];

        foreach ($jobs as $job) {
            array_push($job_array, $job->id);
        }

        $applications = Application::whereIn('job_id', $job_array);

        return view('employers.applications.index', [
            'applications' => $applications->paginate(5),
        ]);
    }

    public function applicant(Application $application)
    {
        $applicant = $application->employee;
        return view('employers.applications.details', [
            'application' => $application,
            'applicant' => $applicant,
        ]);
    }
}
