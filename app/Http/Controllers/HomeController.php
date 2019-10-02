<?php

namespace App\Http\Controllers;

use App\Models\Job;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'jobs' => Job::orderBy('created_at', 'desc')->paginate(5),
        ]);
    }
}
