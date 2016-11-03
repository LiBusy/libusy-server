<?php

use Illuminate\Support\Facades\App;
use App\Contracts\LocationRepositoryInterface;
use App\Support\LocationRepository;
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
App::bind(LocationRepositoryInterface::class, LocationRepository::class);

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'verify.key'], function()
{
    Route::get('busyness/getlevel/{library}', 'BusynessApiController@getBusynessLevel');
    Route::post('busyness/checkin/{library}/{busyness}', 'BusynessApiController@postCheckIn');
    Route::post('usermarkers/postmarker/{lat}/{lng}/{library}', 'UserMarkerController@postMarker')->middleware('verify.coordinates');
    Route::resource('markers', 'MarkerController');
    Route::resource('busyness', 'BusynessApiController');
    Route::resource('usermarkers', 'UserMarkerController');
});


