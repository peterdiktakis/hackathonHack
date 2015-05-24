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
        $location = Session::get('locationName');
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
            $restaurants = null;
            $activities = null;
            $bars = null;
            if (Session::get('bars') != "") $bars = $this->yelp('bar');
            if (Session::get('activities') != "") $activities = $helper->getActivities($startDate, $endDate, Session::get('locationName'));
            if (Session::get('restaurants') != "") $restaurants = $this->yelp('restaurant');


            $geos = array();
            $i = 0;
            foreach($responses['HotelInfoList']['HotelInfo'] as $hotel) {
              $i++;
              $geos[] = [$i, $hotel['Name'], doubleval($hotel['Location']['GeoLocation']['Latitude']), doubleval($hotel['Location']['GeoLocation']['Longitude'])];
            }

            $geos = json_encode($geos);

            return view('pages.results',compact('responses', 'businesses', 'geos', 'restaurants', 'activities', 'bars'));
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

    public function yelp($businessType = null) {

        if (!$businessType) $businessType = Session::get('selection');
        $helper = YelpHelper::getInstance();
        $locationName = Session::get('locationName');
        $longitude = Session::get('longitude');
        $latitude = Session::get('latitude');
        return json_decode($helper->search($businessType, $locationName, $latitude . ',' . $longitude), true);
        //echo($helper->search('restaurant', $locationName, $latitude . ',' . $longitude));
    }
}
