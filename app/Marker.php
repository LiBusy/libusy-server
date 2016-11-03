<?php

namespace App;

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

    protected $appends = ['snippet', 'busyness'];

    public function getSnippetAttribute()
    {
        $busyness = LibraryBusyness::where('library', '=', $this->attributes['library'])->avg('level');
        $users = UserCoordinates::where('library', '=', $this->attributes['library'])->count();
        return $this->attributes['snippet'] = $this->createBusynessText($busyness)
                                                ."\n"
                                                .$users." have checked in.";
    }

    public function getBusynessAttribute()
    {
        return $this->attributes['busyness'] = LibraryBusyness::where('library', '=', $this->attributes['library'])->avg('level');
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
