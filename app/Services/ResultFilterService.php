<?php

namespace App\Services;

class ResultFilterService {
    public function buildQueryType($request) {
        $hotel = $request->hotel;
        $san = $request->san;
        $room = $request->room;
        //checks how many values are set
        $isOn = 0;
        $filter = '';
        if ($hotel == 'on') {
            $filter = 'WHERE%20rodzaj%20=%20%27Hotel%27';
            $isOn++;
        }
        if ($san == 'on') {
            if ($isOn == 0) {
                $filter = 'WHERE%20rodzaj%20=%20%27Sanatorium%27';
            }
            else {
                $filter = $filter.'OR%20rodzaj%20=%20%27Sanatorium%27';
            }
            $isOn++;
        }
        if ($room == 'on') {
            if ($isOn == 0) {
                $filter = 'WHERE%20rodzaj%20LIKE%20%27%Pokoje%%27';
            }
            else {
                $filter = $filter.'OR%20rodzaj%20LIKE%20%27%Pokoje%%27';
            }
            $isOn++;
        }

        return $filter;
    }

    public function assignFeaturesToResults($request, $result) {
        //gets the variables from URL
        $fromSea = $request->sea;
        $fromBike = $request->bike;
        $fromPark = $request->park;
        $fromPlayground = $request->playground;
        $fromDogpark = $request->dogpark;
        

        //gets the arrays with information about objects        
        $bike = DataService::getAttractions('bike');
        $playground = DataService::getAttractions('playground');
        $park = DataService::getAttractions('park');
        $dogPark = DataService::getAttractions('dogpark');


         //gets the arrays with information about objects for each hotel
         for ($i=0; $i < count($result); $i++) { 
            $result[$i]['from_sea'] = ceil(calculateDistance($result[$i]['x'], $result[$i]['y'], (float)$this->distanceToSee($result[$i]['y'])['x'], $result[$i]['y'])*0.016);
            $result[$i]['for_testing'] = $this->distanceToSee($result[$i]['y']);

            $nearestBike = $this->nearestObject($result[$i], $bike);
            $result[$i]['from_bike'] = $nearestBike;

            $nearestPlayground = $this->nearestObject($result[$i], $playground);
            $result[$i]['from_playground'] = $nearestPlayground;

            $nearestPark = $this->nearestObject($result[$i], $park);
            $result[$i]['from_park'] = $nearestPark;

            $nearestDogpark = $this->nearestObject($result[$i], $dogPark);
            $result[$i]['from_dogpark'] = $nearestDogpark;

            //accuracy of the result
            $accuracy = 0;
            $multiplier = 0.5;
            if ($fromSea != null && is_numeric($fromSea)) $accuracy = $accuracy + ($result[$i]['from_sea'] * $fromSea)*$multiplier;
            if ($fromBike != null && is_numeric($fromBike)) $accuracy = $accuracy + ($nearestBike * $fromBike)*$multiplier;
            if ($fromPark != null && is_numeric($fromPark)) $accuracy = $accuracy + ($nearestPark * $fromPark)*$multiplier;
            if ($fromPlayground != null && is_numeric($fromPlayground)) $accuracy = $accuracy + ($nearestPlayground * $fromPlayground)*$multiplier;
            if ($fromDogpark != null && is_numeric($fromDogpark)) $accuracy = $accuracy + ($nearestDogpark * $fromDogpark)*$multiplier;

            if ($result[$i]['nazwa_obiektu'] == null || $result[$i]['nazwa_obiektu'] == '') $accuracy = 1000;
            
            $result[$i]['accuracy'] = $accuracy/10;

            //determine which 2 distances to show
            $showOne = [$fromSea, 'sea'];
            $showTwo = [$fromBike, 'bike'];
            if ($fromPark > $showOne[0]) {
               $showOne[1] = 'park';
            } else if ($fromPark > $showTwo[0]) {
                $showTwo[1] = 'park';
            }

            if ($fromPlayground > $showOne[0]) {
                $showOne[1] = 'playground';
            } else if ($fromPlayground > $showTwo[0]) {
                $showTwo[1] = 'playground';
            }

            if ($fromDogpark > $showOne[0]) {
            $showOne[1] = 'dogpark';
            } else if ($fromDogpark > $showTwo[0]) {
                $showTwo[1] = 'dogpark';
            }

            $result[$i]['showOne'] = $showOne;
            $result[$i]['showTwo'] = $showTwo;

            //extract stars from the name
            $result[$i]['stars'] = substr_count($result[$i]['nazwa_obiektu'], "*");
            $result[$i]['nazwa_obiektu'] = preg_replace('/\*{2,}/', '', $result[$i]['nazwa_obiektu']);

            //assign the features
            if ($result[$i]['stars'] > 3) $result[$i]['features']['high_standard'] = true;
            if (ceil(calculateDistance($result[$i]['x'], $result[$i]['y'], 54.181981, 15.570071))*0.015 < 8 || ceil(calculateDistance($result[$i]['x'], $result[$i]['y'], 54.175182, 15.559306))*0.015 < 8) $result[$i]['features']['train'] = true;
            if (ceil(calculateDistance($result[$i]['x'], $result[$i]['y'], 54.177812, 15.572581))*0.015 < 10) $result[$i]['features']['city_center'] = true;
            if (ceil(calculateDistance($result[$i]['x'], $result[$i]['y'], 54.186329, 15.554450))*0.015 < 10) $result[$i]['features']['lighthouse'] = true;
            if ($nearestPark < 5) $result[$i]['features']['greenery'] = true;
        }

        return $result;
    }

    public function assignFeaturesToSingleResult($id, $arrayResponse) {
        $result = $arrayResponse['result']['records'][0];

        //gets the arrays with information about objects 
        $bike = DataService::getAttractions('bike');
        $playground = DataService::getAttractions('playground');
        $park = DataService::getAttractions('park');
        $dogPark = DataService::getAttractions('dogpark');


        //get the neartest object
        $result['from_sea'] = ceil(calculateDistance($result['x'], $result['y'], (float)$this->distanceToSee($result['y'])['x'], $result['y'])*0.016);

        $nearestBike = $this->sortObjectsByDistance($result, $bike);
        $result['from_bike'] = $nearestBike[0];

        $nearestPark = $this->sortObjectsByDistance($result, $park);
        $result['from_park'] = $nearestPark[0];

        $nearestPlayground = $this->sortObjectsByDistance($result, $playground);
        $result['from_playground'] = $nearestPlayground[0];

        $nearestDogpark = $this->sortObjectsByDistance($result, $dogPark);
        $result['from_dogpark'] = $nearestDogpark[0];

        //get the landmarks to show
        $landmarks = DataService::getAttractions('landmarks');
        $sortedLandmarks = $this->sortObjectsByDistanceZ($result, $landmarks);

        $otherHotels = DataService::getAttractions('allHotels');
        $sortedOtherHotels = $this->sortObjectsByDistance($result, $otherHotels);

        //count the stars
        $result['stars'] = substr_count($result['nazwa_obiektu'], "*");

        return [$result, $sortedLandmarks, $sortedOtherHotels];
    }

    public function assignFeaturesToResultsSearchquery($result) {
        //gets the arrays with information about objects        
        $bike = DataService::getAttractions('bike');
        $playground = DataService::getAttractions('playground');
        $park = DataService::getAttractions('park');
        $dogPark = DataService::getAttractions('dogpark');

        //gets the arrays with information about objects for each hotel
        for ($i=0; $i < count($result); $i++) { 
            $result[$i]['from_sea'] = ceil(calculateDistance($result[$i]['x'], $result[$i]['y'], (float)$this->distanceToSee($result[$i]['y'])['x'], $result[$i]['y'])*0.016);

            $nearestBike = $this->nearestObject($result[$i], $bike);
            $result[$i]['from_bike'] = $nearestBike;

            $nearestPlayground = $this->nearestObject($result[$i], $playground);
            $result[$i]['from_playground'] = $nearestPlayground;

            $nearestPark = $this->nearestObject($result[$i], $park);
            $result[$i]['from_park'] = $nearestPark;

            $nearestDogpark = $this->nearestObject($result[$i], $dogPark);
            $result[$i]['from_dogpark'] = $nearestDogpark;

            //extract stars from the name
            $result[$i]['stars'] = substr_count($result[$i]['nazwa_obiektu'], "*");
            $result[$i]['nazwa_obiektu'] = preg_replace('/\*{2,}/', '', $result[$i]['nazwa_obiektu']);

            //assign the features
            if ($result[$i]['stars'] > 3) $result[$i]['features']['high_standard'] = true;
            if (ceil(calculateDistance($result[$i]['x'], $result[$i]['y'], 54.181981, 15.570071))*0.015 < 8 || ceil(calculateDistance($result[$i]['x'], $result[$i]['y'], 54.175182, 15.559306))*0.015 < 8) $result[$i]['features']['train'] = true;
            if (ceil(calculateDistance($result[$i]['x'], $result[$i]['y'], 54.177812, 15.572581))*0.015 < 10) $result[$i]['features']['city_center'] = true;
            if (ceil(calculateDistance($result[$i]['x'], $result[$i]['y'], 54.186329, 15.554450))*0.015 < 10) $result[$i]['features']['lighthouse'] = true;
            if ($nearestPark < 5) $result[$i]['features']['greenery'] = true;
        }
        
        //get only a certain number of hotels
        $finalResult = array_slice($result, 0, 8, true);
    }

    private function nearestObject($hotel, $objects) {
        // stop the function if given variables aren't arrays
        if (!is_array($hotel) || !is_array($objects)) {
            return null;
        }

        for ($j=0; $j < count($objects); $j++) { 
            $locations[$j] = ceil(calculateDistance($hotel['x'], $hotel['y'], $objects[$j]['x'], $objects[$j]['y'])*0.015);
        }
        sort($locations);
        $closestLocation = $locations[0];

        return $closestLocation;
    }

    //only works for zabytki 
    private function sortObjectsByDistanceZ($hotel, $objects) {
        if (!is_array($hotel) || !is_array($objects)) {
            return null;
        }
        
        for ($j=0; $j < count($objects); $j++) { 
            $objects[$j]['distance'] = ceil(calculateDistance($hotel['x'], $hotel['y'], $objects[$j]['y'], $objects[$j]['x'])*0.015);
        }

        $keys = array_column($objects, 'distance');
        array_multisort($keys, SORT_ASC, $objects);

        return $objects;
    }

      //works for everything else
      function sortObjectsByDistance($hotel, $objects) {
        if (!is_array($hotel) || !is_array($objects)) {
            return null;
        }
        
        for ($j=0; $j < count($objects); $j++) { 
            $objects[$j]['distance'] = ceil(calculateDistance($hotel['x'], $hotel['y'], $objects[$j]['x'], $objects[$j]['y'])*0.015);
        }

        $keys = array_column($objects, 'distance');
        array_multisort($keys, SORT_ASC, $objects);

        return $objects;
    }

    function distanceToSee($y) {
        $coords = array(
            ['x' => '54.179405', 'y' => '15.537467'],
            ['x' => '54.186586', 'y' => '15.552023'],
            ['x' => '54.187415', 'y' => '15.553932'],
            ['x' => '54.187029', 'y' => '15.561838'],
            ['x' => '54.186512', 'y' => '15.573763'],
            ['x' => '54.187739', 'y' => '15.589561'],
            ['x' => '54.189045', 'y' => '15.598767'],
            ['x' => '54.190866', 'y' => '15.608132'],
            ['x' => '54.192233', 'y' => '15.616410'],
            ['x' => '54.193440', 'y' => '15.623996'],
            ['x' => '54.194257', 'y' => '15.628518'],
            ['x' => '54.189898', 'y' => '15.603931'],
            ['x' => '54.195304', 'y' => '15.634314'],
            ['x' => '54.196192', 'y' => '15.639473'],
            ['x' => '54.196883', 'y' => '15.644346'],
            ['x' => '54.197122', 'y' => '15.647583'],
            ['x' => '54.198031', 'y' => '15.656133'],
            ['x' => '54.198605', 'y' => '15.660401'],
        );

        //find cloest y from array to passed y
        $closest = null;
        foreach ($coords as $coord) {
            if ($closest === null || abs($y - $closest) > abs($coord['y'] - $y)) {
                $closest = $coord['y'];
                $closestArray = $coord;
            }
        }
        return $closestArray;
    }

}