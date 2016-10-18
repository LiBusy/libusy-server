<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCoordinates extends Model
{
    protected $table = 'user_marker_coordinates';
    public $timestamps = false;
    protected $fillable = ['lat', 'lng', 'timestamp'];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float'
    ];
}
