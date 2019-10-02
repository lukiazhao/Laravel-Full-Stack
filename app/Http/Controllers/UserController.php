<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Socialite;
use App\Models\User;

use App\Models\Employee;

class UserController extends Controller
{
    public function savedJobs()
    {
        return view('users.saved_jobs', [
            'jobs' => Auth::user()->savedJobs,
        ]);
    }

     /**
     * Redirect the user to the linkedin authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('linkedin')->setScopes(['r_liteprofile', 'r_emailaddress', 'w_member_social'])->redirect();
    }

    /**
     * Obtain the user information from linkedin.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $linkedinUser = Socialite::driver('linkedin')->user();
        
        if (User::where('linkedin_id', $linkedinUser->id)->count() === 0) {
            // create
            $user = User::create([
                'name' => $linkedinUser->name,
                'email' => $linkedinUser->email,
                'password' => 'aaa',
                'is_employer' => 0,
                'linkedin_id' => $linkedinUser->id,
                'linkedin_name' => $linkedinUser->name,
                'linkedin_token' => $linkedinUser->token,
            ]);
            Employee::create([
                'user_id' => $user->id,
            ]);

            Auth::login($user);
        } else {
            // update
            $user = User::where('linkedin_id', $linkedinUser->id)->first();
            $user->linkedin_id = $linkedinUser->id;
            $user->linkedin_name = $linkedinUser->name;
            $user->linkedin_token = $linkedinUser->token;
            $user->save();

            Auth::login($user);
        }

        return redirect()->route('home');
    }
}
