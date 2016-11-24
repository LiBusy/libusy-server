<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $table = 'markers';
    public $timestamps = false;
    //protected $fillable = ['lat', 'lng', 'timestamp'];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float'
    ];

    protected $appends = ['check_ins'];

//    public function getSnippetAttribute()
//    {
//        $busyness = LibraryBusyness::where('library', '=', $this->attributes['library'])->avg('level');
//        $users = UserCoordinates::where('library', '=', $this->attributes['library'])->count();
//        return $this->attributes['snippet'] = $this->createBusynessText($busyness)
//                                                ."\n"
//                                                .$users." have checked in.";
//    }

//    public function getBusynessAttribute()
//    {
//        $busyness = LibraryBusyness::where('library', '=', $this->attributes['library'])->avg('level');
//        return $this->attributes['busyness'] = $this->createBusynessText($busyness);
//    }
//
//    public function setBusynessAttribute($value)
//    {
//        $this->attributes['busyness'] = $value;
//    }

    public function getCheckInsAttribute()
    {
        return $this->attributes['check_ins'] = UserCoordinates::where('library', '=', $this->attributes['library'])
                                                                ->where('timestamp', '>=', Carbon::parse('1 hours ago'))
                                                                ->count().' bones in the past hour.';
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
