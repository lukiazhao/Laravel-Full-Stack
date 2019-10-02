<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Type;
use App\Models\Classification;
use Auth;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('keyword');
        $classification = $request->query('selectedClassification');  // classification id
        $type = $request->query('selectedType');    //type id

        // check if selectedClassification/selectedType is null, cast only if not null.
        if ($classification) {
            $classification = (int) $classification;
        }

        if ($type) {
            $type = (int) $type;
        }
        
        $jobs = Job::when($classification, function ($query, $classification) {
            return $query->join('classification_job', 'classification_job.job_id', '=', 'jobs.id')
            ->where('classification_job.classification_id', '=', $classification);
        })
        ->when($type, function ($query, $type) {
            return $query->where('type_id', '=', $type);
        })
        ->when($keyword, function ($query, $keyword) {
            return $query->where('title', 'like', "%{$keyword}%");
        })
        ->select('jobs.*')
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        
        return view('jobs.index', [
            'jobs' => $jobs,
            'classifications' => Classification::orderBy('name')->get(),
            'types' => Type::all(),
            'selectedClassification' => $classification,
            'selectedType' => $type,
            'keyword' => $keyword,
        ]);
    }

    /**
     * @param id int $id Job id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(int $id)
    {
        $job = Job::find($id);
        return view('jobs.show', [
            'job' => $job,
        ]);
    }

    /**
     * @param id int $id Job id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function toggleSave(int $id)
    {
        $job = Job::findOrFail($id);

        Auth::user()->savedJobs()->toggle($job->id);
        
        $jobAdded = Auth::user()->savedJobs()
            ->where('job_id', $job->id)
            ->first();

        $result = $jobAdded === null ? 'removed' : 'saved';

        return response()->json([
            'job_id' => $job->id,
            'result' => $result
        ], 200);
    }
}
