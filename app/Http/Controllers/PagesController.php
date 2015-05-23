<?php namespace App\Http\Controllers;

use App\Http\Requests;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Request;
use App\Helpers\GeoHelper;

class PagesController extends Controller {

    public function about()
    {
//        $helper = GeoHelper::getInstance();
//        $locations = $helper->get('Montreal');
        return view('pages.about');
    }

    public function test()
    {
        $helper = GeoHelper::getInstance();
        $location = Request::get('location');
        $locations = $helper->get($location);

        $cities = array();
        foreach($locations as $location) {
            $cities[] = $location['name'];
        }
        return $cities;

        //return $input;

    }
    public function landing()
    {
        return view('pages.landing');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
