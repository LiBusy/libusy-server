<?php namespace App;

class LocationRepository implements LocationRepositoryInterface
{

    public function getAll($placeId)
    {
        $url = 'https://maps.googleapis.com/maps/api/place/details/json?placeid='.$placeId.'&key=AIzaSyAseWPTr6P88XO1gm78yUq5MkR9pu1t7jA';
        $ch = curl_init($url);
        $output = curl_exec($ch);
        return $output;
        //$response = http_get($url);
        //return $response;
    }
}