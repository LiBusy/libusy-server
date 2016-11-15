<?php

namespace App\Http\Controllers;

use App\Contracts\LocationRepositoryInterface;
use App\Marker;
use Illuminate\Http\Request;

use App\Http\Requests;

class MarkerController extends Controller
{

    protected $locations;


    public function __construct(LocationRepositoryInterface $locations) //\App\Contracts\LocationRepositoryInterface $locations
    {
        $this->locations = $locations;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $markers = Marker::all();
        $place = $this->locations->getAll(); // retrieve stdclass object of Places JSON
        dd($place);
        foreach ($markers as $marker) // add fields from Google Places API
        {

            if(isset($place->result->formatted_phone_number))
            {
                $marker->phone_number = $place->result->formatted_phone_number;
            }
            else
            {
                $marker->phone_number = 'Phone number not available';
            }

            if(isset($place->result->formatted_address))
            {
                $marker->address = $place->result->formatted_address;
            }
            else
            {
                $marker->address = 'Address not available';
            }

            if(isset($place->result->opening_hours->open_now))
            {
                $marker->open_now = $this->isOpenNow($place->result->opening_hours->open_now);
            }
            else
            {
                $marker->open_now = 'Open/Closed status not available.';
            }

            if(isset($place->result->name))
            {
                $marker->title = $place->result->name;
            }



        }

        return response()->json($markers);
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

    private function isOpenNow($openNow)
    {
        return $openNow ? 'Open now' : 'Closed now';
    }
}
