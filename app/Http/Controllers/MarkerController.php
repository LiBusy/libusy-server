<?php

namespace App\Http\Controllers;

use App\Contracts\LocationRepositoryInterface;
use App\LibraryBusyness;
use App\Marker;
use App\UserCoordinates;
use Carbon\Carbon;
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
        $place = $this->locations->getAll()->today;
        foreach ($markers as $marker)
        {
            $libraryInfo = $place->libraries[$marker->library_id];
//            if(isset($place->result->formatted_phone_number))
//            {
//                $marker->phone_number = $place->result->formatted_phone_number;
//            }
//            else
//            {
//                $marker->phone_number = 'Phone number not available';
//            }

//            if(isset($place->result->formatted_address))
//            {
//                $marker->address = $place->result->formatted_address;
//            }
//            else
//            {
//                $marker->address = 'Address not available';
//            }

            if(isset($libraryInfo->isOpen))
            {
                $marker->open_now = $this->isOpenNow($libraryInfo->isOpen);
            }
            else
            {
                $marker->open_now = 'Open/Closed status not available.';
            }

            if(isset($libraryInfo->name))
            {
                $marker->title = $libraryInfo->name;
            }

            if(isset($libraryInfo->hours))
            {
                $marker->hours = $libraryInfo->hours;
            }
            else
            {
                $marker->hours = 'hours not available';
            }

            $busyness = LibraryBusyness::where('library', '=', $marker->library)
                                        ->where('timestamp', '>=', Carbon::parse('1 hours ago'))
                                        ->avg('level');
            if($marker->open_now === 'Closed now')
            {
                $marker->busyness = 'Closed now';
            }
            else{
                $marker->busyness = $this->createBusynessText($busyness);
            }

            $marker->total_check_ins = UserCoordinates::where('library', '=', $library)->count();

            $marker->very_busy_votes = LibraryBusyness::where('library', '=', $library)
                ->where('timestamp', '>=', Carbon::parse('1 hours ago'))
                ->where('level', '=', 3)
                ->count();

            $marker->busy_votes = LibraryBusyness::where('library', '=', $library)
                ->where('timestamp', '>=', Carbon::parse('1 hours ago'))
                ->where('level', '=', 2)
                ->count();

            $marker->not_busy_votes = LibraryBusyness::where('library', '=', $library)
                ->where('timestamp', '>=', Carbon::parse('1 hours ago'))
                ->where('level', '=', 1)
                ->count();

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

    private function createBusynessText($response)
    {

        if ((float) $response < 1.5)
        {
            return "Not Busy";
        }

        if ((float) $response < 2.5)
        {
            return "Busy";
        }

        return "Very Busy";
    }
}
