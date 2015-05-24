<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use Response;
use Illuminate\Support\Facades\Session;
use App\Helpers\ApiHelper;
use App\Helpers\YelpHelper;

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
        $businesses = $this->yelp();

        if ($location) {
            $helper = ApiHelper::getInstance();
            $responses = $helper->getHotels($startDate, $endDate, $location, '5km');

            return view('pages.results',compact('responses', 'businesses'));
            //return dd($responses);
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

    public function yelp()
    {
        $selection = Request::get('selection');
        $helper = YelpHelper::getInstance();
        $locationName = Session::get('locationName');
        $longitude = Session::get('longitude');
        $latitude = Session::get('latitude');
        $helper = YelpHelper::getInstance();
        $businessType =Session::get('selection');
        return json_decode($helper->search($businessType, $locationName, $latitude . ',' . $longitude), true);
        //echo($helper->search('restaurant', $locationName, $latitude . ',' . $longitude));
    }
}
