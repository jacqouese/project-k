<?php

function calculateDistance($lat1, $lon1, $lat2, $lon2) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    
    
        return ($miles * 1.609344 *1000);
    
}

function add_query_params(array $params = [])
{
    $query = array_merge(
        request()->query(),
        $params
    ); // merge the existing query parameters with the ones we want to add

    return url()->current() . '?' . http_build_query($query); // rebuild the URL with the new parameters array
}