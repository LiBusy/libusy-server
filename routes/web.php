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

Route::get('busyness/getlevel/{library}', 'BusynessApiController@getBusynessLevel')->middleware('verify.key');
Route::post('busyness/checkin/{library}/{busyness}', 'BusynessApiController@postCheckIn')->middleware('verify.key');
Route::resource('busyness', 'BusynessApiController')->middleware('verify.key');
Route::resource('usermarkers', 'UserMarkerController')->middleware('verify.key');

