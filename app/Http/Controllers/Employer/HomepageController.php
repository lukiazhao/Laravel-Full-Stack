<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Classification;
use App\Models\CompanySize;
use App\Models\Employer;

class HomepageController extends Controller
{
    public function index()
    {
        $employer = Auth::user()->employer;
        return view('employers.homepage.index', [
            'employer' => $employer,
            'classifications' => Classification::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Employer $employer)
    {
        $employer->business_name = $request->business_name;
        $employer->introduction = $request->introduction;
        $employer->city = $request->city;
        $employer->classification_id = $request->classification;
        $employer->detailed_address = $request->detailed_address;
        $employer->website = $request->website;
        $employer->phone_number = $request->phone_number;

        if ($request->hasFile('company_logo')) {
            $logoPath = $request->file('company_logo')->storePublicly('logos', 's3', 'public');
            $employer = Auth::user()->employer;
            $employer->company_logo = $logoPath;
        }


        $employer->save();
        toastr()->success('Homepage update succeed');  // how to avoid showing toast again if user click back button without editing anything.

        return redirect()->route('home');
    }
}
