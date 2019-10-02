<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Classification;
use App\Models\Type;
use App\Models\Job;
use App\Http\Requests\StoreJobRequest;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Auth::user()->employer->jobs()->orderBy('created_at', 'desc')->paginate(10);
        return view('employers.jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('employers.jobs.create', [
            'classifications' => Classification::orderBy('name')->get(),
            'types' => Type::orderBy('name')->get(),
        ]);
    }

    public function store(StoreJobRequest $request)
    {
        $job = new Job();
        $job->title = $request->title;
        $job->city = $request->city;
        $job->suburb = $request->suburb;
        $job->employer_id = Auth::user()->employer->id;
        $job->description = $request->description;
        $job->type_id = $request->type_id;

        if ($request->use_range) {
            $job->salary = $request->salary;
            $job->use_range = true;
        } else {
            $job->salary = (string) $request->salary.'/'.$request->payment_period;
            $job->use_range = false;
        }
        
        $job->closing_date = $request->closing_date;
        $job->save();
        $job->classifications()->sync(Classification::findOrFail($request->classification));    // todo: update to multiple classft
        
        toastr()->success('Successfully Created', $job->title);
        return redirect()->route('employers.jobs.index');
    }

    public function edit(Job $job)
    {
        return view('employers.jobs.edit', [
            'job' => $job,
            'classifications' => Classification::orderBy('name')->get(),
            'types' => Type::orderBy('name')->get(),
        ]);
    }

    public function update(Job $job, StoreJobRequest $request)
    {
        $job->title = $request->title;
        $job->city = $request->city;
        $job->suburb = $request->suburb;
        $job->type_id = $request->type_id;
        $job->closing_date = $request->closing_date;
        $job->description = $request->description;

        if ($request->use_range) {
            $job->salary = $request->salary;
            $job->use_range = true;
        } else {
            $job->salary = (string) $request->salary.'/'.$request->payment_period;
            $job->use_range = false;
        }
        $job->save();
        $job->classifications()->sync(Classification::find($request->classification));

        toastr()->success('Successfully Updated', $job->title);
        return redirect()->route('employers.jobs.index');
    }

    public function delete(Job $job)
    {
        $job->delete();

        toastr()->success('Successfully Deleted', $job->title);
        return redirect()->route('employers.jobs.index');
    }
}
