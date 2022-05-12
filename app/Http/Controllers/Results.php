<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\DataService;
use App\Services\ResultFilterService;

class Results extends Controller
{
    public function getResults(Request $request) {
        $filter = (new ResultFilterService())->buildQueryType($request); // filter type of accomodation
        $response = (new DataService())->getFilteredData($filter); // get data from server
        if ($response === false) return view('500');

        $responseString = $response;
        $result = $responseString['result']['records'];
        $result = (new ResultFilterService())->assignFeaturesToResults($request, $result); // calculate distances for each result
       
        //sort the results by accuracy
        $accuracyKey = array_column($result, 'accuracy');
        array_multisort($accuracyKey, SORT_ASC, $result);
        
        $limit = $request->limit;
        if ($limit == 2) {
            $l = 16;
        }
        else {
            $l = 8;
        }
        $finalResult = array_slice($result, 0, $l, true);

        return view('search', ['results'=>$finalResult, 'limit'=>$l]);
    }

    public function singleResult($id) {
        $response = (new DataService())->getSingleResultData($id); // get data from server
        if ($response === false) return view('500');
        $arrayResponse = json_decode($response->body(), true);

        //check if the given id is valid
        if (array_key_exists('result', $arrayResponse) == true && array_key_exists('records', $arrayResponse['result']) && array_key_exists(0, $arrayResponse['result']['records'])) {
            $results = (new ResultFilterService())->assignFeaturesToSingleResult($id, $arrayResponse);
        }
        else {
            return view('404');
        }

        return view('listing', ['results'=>$results[0], 'landmarks'=>$results[1], 'otherHotels'=>$results[2]]);
    }

    public function searchquery(Request $request, $lang) {
        $response = (new DataService())->getFilteredSearchedData($request); // get data from server
        if ($response === false) return view('searchquery', ['results'=>null, 'query'=>$request->q]);

        $arrayResponse = json_decode($response->body(), true);

        if (array_key_exists('result', $arrayResponse) == true && array_key_exists('records', $arrayResponse['result']) && array_key_exists(0, $arrayResponse['result']['records'])) {
            $results = (new ResultFilterService())->assignFeaturesToSingleResult($arrayResponse);
        }
        else {
            return view('searchquery', ['results'=>null, 'query'=>$request->q]);
        }
        
        return view('searchquery', ['results'=>$finalResult, 'query'=>$request->q]);
    }
}

    
