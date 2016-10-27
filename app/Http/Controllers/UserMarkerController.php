<?php

namespace App\Http\Controllers;

use App\UserCoordinates;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserMarkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserCoordinates::select('lat', 'lng')->get();
    }

    public function postMarker($lat, $lng)
    {
        $marker = new UserCoordinates();
        $marker->lat = $lat;
        $marker->lng = $lng;
        dd($marker);
        if ($marker->lat == 0.0 && $marker->lng = 0.0) // default shared preference value
        {
            return false;
        }
        $marker->timestamp = Carbon::now();
        $marker->save();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
