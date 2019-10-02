<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->group(function () {
    Route::get('/jobs', 'API\JobApiController@getAll');
    Route::get('/jobs/{id}', 'API\JobApiController@get');
    Route::post('/jobs', 'API\JobApiController@create');
    Route::put('/jobs/{id}', 'API\JobApiController@update');
    Route::delete('/jobs/{id}', 'API\JobApiController@delete');
});
