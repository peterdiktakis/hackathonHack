<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use Request;

class SessionController extends Controller {

	public function date()
    {
        $startDate = Request::get('startDate');
        $endDate = Request::get('endDate');
        Session::put('startDate', $startDate);
        Session::put('endDate', $endDate);
        return array($startDate, $endDate);
    }

}
