<?php

namespace App\Services;

class DataService {
    public function getFilteredData($filter) {
        return $this->callHttp('http://www.opendata.gis.kolobrzeg.pl/api/3/action/datastore_search_sql?sql=SELECT%20*%20from%20%22d38fc37b-a515-46a8-9905-8f7bdbd7b2c3%22%20'.$filter);
    }

    public function getSingleResultData($id) {
        return $this->callHttp('http://www.opendata.gis.kolobrzeg.pl/api/3/action/datastore_search_sql?sql=SELECT%20*%20from%20%22d38fc37b-a515-46a8-9905-8f7bdbd7b2c3%22%20WHERE%20_id%20=%20%27'.$id.'%27');
    }

    public function getFilteredSearchedData($request) {
        $query = mb_strtoupper($request->q);
        $query = str_replace(array('Ą', 'Ć', 'Ę', 'Ł', 'Ń', 'Ó', 'Ś', 'Ź', 'Ż'), array('A', 'C', 'E', 'L', 'N', 'O', 'S', 'Z', 'Z'), $query);

        return $this->callHttp('http://www.opendata.gis.kolobrzeg.pl/api/3/action/datastore_search_sql?sql=SELECT%20*%20from%20%22d38fc37b-a515-46a8-9905-8f7bdbd7b2c3%22%20WHERE%20upper%28nazwa_obiektu%29%20LIKE%20%27%'.$query.'%%27');
    }

    private function callHttp($httpString) {
        try {
            return $response = Http::get($httpString);
        } catch (\Throwable $th) {
            return false;
        }

        if ($response->successful() == 0) {
            return false;
        }
    }

    public static function getAttractions($id) {
        switch ($id) {
            case 'bike':
                $response = Http::get('http://www.opendata.gis.kolobrzeg.pl/api/3/action/datastore_search?resource_id=4a25e4e2-6a34-47ce-b68b-6517b4b1e431');
                break;
            case 'park':
                $response = Http::get('http://www.opendata.gis.kolobrzeg.pl/api/3/action/datastore_search?resource_id=3a2fe7f5-7d84-414c-9f34-a49e84b8fc4f'); //need to select parks only
                break;  
            case 'playground':
                $response = Http::get('http://www.opendata.gis.kolobrzeg.pl/api/3/action/datastore_search?resource_id=36f2b1ed-580f-4c76-962d-6d4f4aae0dd8');
                break;     
            case 'dogpark':
                $response = Http::get('http://www.opendata.gis.kolobrzeg.pl/api/3/action/datastore_search?resource_id=6a170f39-ffe4-4bc2-9b27-05a7d14a1b12');
                break;     
            case 'landmarks':
                $response = Http::get('http://www.opendata.gis.kolobrzeg.pl/api/3/action/datastore_search?resource_id=3c1ec4e7-5f34-419e-a0c2-8a97bba7c2bb');
                break;     
            case 'allHotels':
                $response = Http::get('http://www.opendata.gis.kolobrzeg.pl/api/3/action/datastore_search_sql?sql=SELECT%20*%20from%20%22d38fc37b-a515-46a8-9905-8f7bdbd7b2c3%22%20');
                break;     
            default:
                $response = null;
                break;
        }

        if ($response->successful() == 0) {
            return false;
        }

        if ($response !== null) {
            $response = $response['result']['records'];
            
        }
        
        return $response;
    }

   
}