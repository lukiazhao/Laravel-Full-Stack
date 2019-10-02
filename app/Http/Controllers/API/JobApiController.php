<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobCollection;
use App\Http\Resources\Job as JobResource;
use App\Models\Job;
use App\Models\Classification;
use Auth;

class JobApiController extends Controller
{
    public function getAll()
    {
        return new JobCollection(Job::paginate());
    }

    public function get(int $id)
    {
        return new JobResource(Job::find($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $job->classifications()->sync(Classification::findOrFail($request->classification));
        
        return new JobResource($job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $job = Job::find($id);
        
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
        return new JobResource($job);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
        $job = Job::find($id);
        $job->delete();

        return response()->json([
            'message' => "delete successfully",
        ]);
    }
}
