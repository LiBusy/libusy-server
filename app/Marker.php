<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $table = 'markers';
    public $timestamps = false;
    protected $fillable = ['lat', 'lng', 'timestamp', 'address', 'open_now', 'phone_number'];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float'
    ];

    protected $attributes = array(
        'address' => 'Address not available.',
        'open_now' => '',
        'phone_number' => 'Phone number not available.'
    );

    protected $appends = ['snippet'];

    public function getSnippetAttribute()
    {
        $busyness = LibraryBusyness::where('library', '=', $this->attributes['library'])->avg('level');
        $users = UserCoordinates::where('library', '=', $this->attributes['library'])->count();
        return $this->attributes['snippet'] = $this->createBusynessText($busyness)
                                                ."\n"
                                                .$users." have checked in.";
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
