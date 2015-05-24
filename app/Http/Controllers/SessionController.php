<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Helpers\YelpHelper;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use League\Geotools\Coordinate\Coordinate;
use \League\Geotools\Geotools;
use Request;
use Route;

class SessionController extends Controller {

	public function date()
    {
        if (Request::ajax())
        {
            $startDate = Request::get('startDate');
            $endDate = Request::get('endDate');
            Session::put('startDate', $startDate);
            Session::put('endDate', $endDate);
            return array($startDate, $endDate);
        }
    }

    public function location()
    {
			if (Request::ajax()) {
                Session::forget('locationName');
                Session::forget('longitude');
                Session::forget('latitude');
                $locationName = Request::get('locationName');
                $longitude = Request::get('longitude');
                $latitude = Request::get('latitude');

                Session::put('locationName', $locationName);
                Session::put('longitude', $longitude);
                Session::put('latitude', $latitude);

//                $helper = YelpHelper::getInstance();
//                echo($helper->search('restaurant', $locationName, $latitude . ',' . $longitude));

            }
	}
    public function storeSelections()
    {
          // store users activity / business selections in session.
            $activities = Request::get('activities');
            $bars = Request::get('bars');
            $restaurants = Request::get('restaurants');
            Session::forget('activities');
            Session::forget('bars');
            Session::forget('restaurants');
            if (isset($activities)) Session::put('activities', $activities);
            if (isset($bars)) Session::put('bars', $bars);
            if (isset($restaurants)) Session::put('restaurants', $restaurants);
    }

}
