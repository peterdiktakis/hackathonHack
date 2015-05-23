<?php namespace App\Helpers;

use GuzzleHttp\Client;

class GeoHelper {

    private $publicKey;
    private $privateKey;
    private $client;

    protected static $instance = null;

    protected function __construct()
    {
        $this->publicKey = $_ENV['API_PUBLIC_KEY'];
        $this->privateKey = $_ENV['API_SECRET_KEY'];
        $this->client = new Client();
    }

    protected function __clone()
    {

    }

    public static function getInstance()
    {
       if (!isset(static::$instance)) {
           static::$instance = new static;
       }
       return static::$instance;
    }

    /**
     * @param $location
     * @return list of cities / locations
     */
    public function get($location)
    {
        $response = $this->client->get('http://terminal2.expedia.com/x/geo/features?ln.op=cn', [
            'query' => [
                        'ln.value' => $location,
                        'type' => 'region',
                        'apikey' => $this->publicKey]
                         ]);
        $locations = $response->json();

        $cities = array();
        foreach($locations as $location) {
            $cities[] = $location['name'];
        }

        return $cities;
    }
}