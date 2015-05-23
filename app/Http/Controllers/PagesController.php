<?php namespace App\Http\Controllers;

use App\Http\Requests;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\GeoHelper;

class PagesController extends Controller {

    public function about()
    {
        $helper = GeoHelper::getInstance();
        dd($helper->get('Montreal'));

//        $key = 'wpZa7emWeoA9fG6xP6FIbxMKoNvlAjZE';
//        $client = new Client();
//        $geo = 'http://terminal2.expedia.com/x/geo/features?ln.op=cn&ln.value=San Francisco&type=region&apikey=';
//        $response = $client->get($geo . $key);
//
//        dd($response->json());
     //   return view('pages.about');
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
		//
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
