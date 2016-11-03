<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'verify.key'], function()
{
    \Illuminate\Support\Facades\App::bind('App\LocationRepositoryInterface', 'App\LocationRepository');
    Route::get('busyness/getlevel/{library}', 'BusynessApiController@getBusynessLevel');
    Route::post('busyness/checkin/{library}/{busyness}', 'BusynessApiController@postCheckIn');
    Route::post('usermarkers/postmarker/{lat}/{lng}/{library}', 'UserMarkerController@postMarker')->middleware('verify.coordinates');
    Route::resource('markers', 'MarkerController');
    Route::resource('busyness', 'BusynessApiController');
    Route::resource('usermarkers', 'UserMarkerController');
});


