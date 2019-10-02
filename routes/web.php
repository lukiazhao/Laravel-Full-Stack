<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('jobs/{id}', 'JobController@show')->name('jobs.show');

Route::get('about', function () {
    return view('about');
});

Route::get('/jobs', 'JobController@index')->name('jobs.index');

Route::post('/jobs/{id}/save', 'JobController@toggleSave')
    ->middleware('auth')
    ->name('jobs.saved');

Route::get('/me/saved-jobs', 'UserController@savedJobs')->name('users.savedJobs');

// Employee profile
Route::middleware(['auth', 'employee'])
    ->prefix('me/profile')->name('profile.')->group(function () {
        Route::get('/', 'Employee\ProfileController@profile')->name('index');
        Route::post('/phone-number', 'Employee\ProfileController@updatePhoneNumber')->name('phone.update');
        Route::post('/summary', 'Employee\ProfileController@updateSummary')->name('summary.update');
        Route::post('/work-experience', 'Employee\ProfileController@updateWorkExperience')
        ->name('work.update');
        Route::delete('/work-experience/{workExperience}', 'Employee\ProfileController@removeWorkExperience')
        ->name('work.delete');

        Route::post('/resume', 'Employee\ProfileController@updateResume')
        ->name('resume.update');
    });

// Employee Applications
Route::middleware(['auth', 'employee'])
    ->prefix('apply')->name('employees.applications.')->group(function () {
        Route::get('/{job}', 'Employee\ApplicationController@create')
        ->name('create');

        Route::post('/{job}', 'Employee\ApplicationController@store')
        ->name('store');

        Route::get('/edit/{application}', 'Employee\ApplicationController@edit')->name('edit');
        Route::put('/edit/{application}', 'Employee\ApplicationController@update')->name('update');

        Route::get('/', 'Employee\ApplicationController@index')->name('index');
        Route::delete('/delete/{application}', 'Employee\ApplicationController@delete')->name('delete');
    });

// Employer Job Routes
Route::middleware(['auth', 'employer'])
    ->prefix('employers')->name('employers.')->group(function () {
        Route::prefix('jobs')->name('jobs.')->group(function () {
            Route::get('/', 'Employer\JobController@index')->name('index');
            Route::get('create', 'Employer\JobController@create')->name('create');
            Route::post('/', 'Employer\JobController@store')->name('store');
            Route::get('/{job}/edit', 'Employer\JobController@edit')->name('edit');
            Route::put('/{job}', 'Employer\JobController@update')->name('update');
            Route::delete('/{job}', 'Employer\JobController@delete')->name('delete');
        });
    });

// Employer Homepage
Route::get('/me/homepage', 'Employer\HomepageController@index')->middleware('employer')->name('employers.homepage');

Route::post('/me/homepage/update/{employer}', 'Employer\HomepageController@update')->name('employers.homepage.update');

// Employer Received Applications
Route::get('/applications', 'Employer\ApplicationController@index')->middleware('employer')->name('employers.applications.index');
Route::get('/applicant-detail/{application}', 'Employer\ApplicationController@applicant')->middleware('employer')->name('employers.applications.details');


// OAuth Provider : LinkedIn
Route::get('login/linkedin', 'UserController@redirectToProvider')->name('login.linkedin');
Route::get('login/linkedin/callback', 'UserController@handleProviderCallback');

// LinkedIn Route
Route::post('jobs/share/{job}', 'Employee\JobController@share')->name('jobs.share');
