<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Application;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationReceived;

class ApplicationController extends Controller
{

    public function index()
    {
        $applications = Auth::user()->employee->applications()->orderBy('created_at', 'desc')->paginate(5);
        
        return view('employees.applications.index', [
            'applications' => $applications,
        ]);
    }

    public function create(Job $job)
    {
        return view('employees.applications.create', [
            'job' => $job,
        ]);
    }
    
    public function store(Request $request, Job $job)
    {
        $application = new Application();
        $application->employee_id = Auth::user()->employee->id;
        $application->job_id = $job->id;
        $application->see_phone_number = $request->see_phone_number ? true : false;
        $application->attach_resume = $request->attach_resume ? true : false;
        if (!$request->message) {
            $application->message = $request->message;
        }

        $application->save();

        Mail::to($application->job->employer->user)->send(new ApplicationReceived($application));


        toastr()->success('Application has been submitted', $job->title);

        return redirect()->route('jobs.show', [
            'job' => $job,
        ]);
    }

    public function edit(Application $application)
    {
        return view('employees.applications.edit', [
            'application' => $application,
        ]);
    }

    public function update(Application $application, Request $request)
    {
        $application->see_phone_number = $request->see_phone_number ? true : false;
        $application->attach_resume = $request->attach_resume ? true : false;
        $application->message = $request->message;
        $application->save();
        return redirect()->route('employees.applications.index');
    }

    public function delete(Application $application)
    {
        $application->delete();
        toastr()->success('Successfully Deleted', $application->job->title);

        return redirect()->route('employees.applications.index');
    }
}
