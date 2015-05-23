<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use App\Helpers\GeoHelper;

class ApiController extends Controller {

	public function suggestions()
    {
        $helper = GeoHelper::getInstance();
        $location = Request::get('location');
        return $helper->get($location);
    }

}
