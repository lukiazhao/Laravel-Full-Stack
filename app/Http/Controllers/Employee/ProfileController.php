<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\WorkExperience;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $profile = Auth::user()->employee;
        return view('employees.profile', [
            'user' => Auth::user(),
            'profile' => $profile,
            'work_experiences' => $profile->workExperiences,
        ]);
    }
    
    public function updatePhoneNumber(Request $request)
    {
        $employee = Auth::user()->employee;
        if ($request->text) {
            $employee->phone_number = $request->text;
            $employee->save();
        }
    
        return response()->json([
            'phone_number' =>  $employee->phone_number,
        ], 200);
    }

    public function updateSummary(Request $request)
    {
        $employee = Auth::user()->employee;
        $employee->summary = $request->text;
        $employee->save();

        return response()->json([
            'summary' =>  $employee->summary,
        ], 200);
    }

    public function updateWorkExperience(Request $request)
    {
        $isNew = false;

        if ($request->work_experience_id) {
            // update work experience
            $workExperience = WorkExperience::find($request->work_experience_id);
            $workExperience->position = $request->position;
            $workExperience->company = $request->company;
            $workExperience->startDate = $request->startDate;
            $workExperience->endDate = $request->endDate;
            $workExperience->job_duties = $request->job_duties;
            $workExperience->save();
        } else {
            // create new work experience
            $workExperience = new WorkExperience();
            $workExperience->employee_id = Auth::user()->employee->id;
            $workExperience->position = $request->position;
            $workExperience->company = $request->company;
            $workExperience->startDate = $request->startDate;
            $workExperience->endDate = $request->endDate;
            $workExperience->job_duties = $request->job_duties;
            $workExperience->save();
            $isNew = true;
        }

        return response()->json([
            'id' => $workExperience->id,
            'position' => $workExperience->position,
            'company' =>  $workExperience->company,
            'startDate' => $workExperience->startDate,
            'endDate' => $workExperience->endDate,
            'job_duties' => $workExperience->job_duties,
            'isNew' => $isNew,
        ], 200);
    }

    public function removeWorkExperience(WorkExperience $workExperience)
    {
        $workExperience->delete();
        return response()->json(['success' => 'success'], 200);
    }

    public function updateResume(Request $request)
    {
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->storePublicly('resumes', 's3', 'public');
            $employee = Auth::user()->employee;
            $employee->resume_path = $resumePath;
            $employee->save();
        }

        return response()->json([
            'resume_path'=> $employee->resume_path
        ], 200);
    }
}
