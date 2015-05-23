<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use App\Helpers\ApiHelper;

class ApiController extends Controller {

	public function suggestions()
    {
        $location = Request::get('location');
        $helper = ApiHelper::getInstance();
        return $helper->getCities($location);
    }

    public function todo()
    {
        
    }



}
