<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use Response;
use Illuminate\Support\Facades\Session;
use App\Helpers\ApiHelper;

class ApiController extends Controller {

    public function activities()
    {

        $startDate = Session::get('startDate');
        $endDate = Session::get('endDate');
        $location = Session::get('location');
        if ($location) {
            $helper = ApiHelper::getInstance();
            $results = $helper->getActivities($startDate, $endDate, $location);
            return dd($results);
        }
    }
    public function hotel()
    {
        $startDate  = Session::get('startDate');
        $endDate = Session::get('endDate');
        $longitude = Session::get('longitude');
        $latitude = Session::get('latitude');
        $location = ($longitude && $latitude) ? ($latitude . ',' . $longitude) : Session::get('locationName');

        if ($location) {
            $helper = ApiHelper::getInstance();
            $response = $helper->getHotels($startDate, $endDate, $location, '5km');
            return $response;
        }
    }

    public function suggestions()
    {
        $location = Request::get('location');
        if ($location) {
            $helper = ApiHelper::getInstance();
            $response = $helper->getCities($location);
            return Response::json($response);
        } else {
            return null;
        }
    }
}
