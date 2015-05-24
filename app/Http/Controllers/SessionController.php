<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Helpers\YelpHelper;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use League\Geotools\Coordinate\Coordinate;
use \League\Geotools\Geotools;
use Request;

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
			if (Request::ajax())
			{
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

}
