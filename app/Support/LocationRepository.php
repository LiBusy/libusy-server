<?php

namespace App\Support;

use App\Contracts\LocationRepositoryInterface;

class LocationRepository implements LocationRepositoryInterface
{

    public function getAll()
    {
        //$url = 'https://maps.googleapis.com/maps/api/place/details/json?placeid='.$placeId.'&key=AIzaSyAseWPTr6P88XO1gm78yUq5MkR9pu1t7jA';
        $url = 'http://www.lib.ua.edu/libhours2/api/today';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output);
        //$response = http_get($url);
        //return $response;
    }
}