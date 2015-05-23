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
        //http://terminal2.expedia.com/x/activities/search?location=London&apikey={INSERT_YOUR_API_KEY}
    }
    public function hotel()
    {
        $startDate  = Session::get('startDate');
        $endDate = Session::get('endDate');
        $location = Session::get('location');
        if ($startDate && $endDate && $location) {
            $helper = ApiHelper::getInstance();
            $results = $helper->getHotels($startDate, $endDate, $location);
            return dd($results);
        } else {
            return array($startDate, $endDate, $location);
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
