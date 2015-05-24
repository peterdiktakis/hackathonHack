<?php namespace App\Helpers;

use GuzzleHttp\Client;

class ApiHelper {

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
        // no cloning allowed
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
    public function getCities($location)
    {
        $response = $this->client->get('http://terminal2.expedia.com:80/x/nlp/results?', [
            'query' => [
                'q' => $location,
                'limit' => 10,
                'verbose' => FALSE,
                'apikey' => $this->publicKey]
        ]);
        $locations = $response->json();
        $cities = array('suggestions' => array());

        if (isset($locations['result']['neighborhoods'])) {
            foreach ($locations['result']['neighborhoods'] as $location) {
                $center = $location['center'];
                $cities['suggestions'][] = array("value" => $location['name'], 'data' => $location['id'], 'longitude' => $center['lng'], 'latitude' => $center['lat']);
              }
        }
        return $cities;
    }

    public function getHotels($startDate, $endDate, $location, $radius = '5km')
    {
        $response = $this->client->get('http://terminal2.expedia.com/x/hotels?', [
            'query' => [
                'location' => $location,
                'radius' => $radius,
                'dates' => $startDate . ',' . $endDate,
                'apikey' => $this->publicKey]
        ]);
        $locations = $response->json();
        return $locations;
    }

    public function getActivities($startDate, $endDate, $location)
    {
        if ($startDate && $endDate) {
            $query = ['query' => ['location' => $location, 'startDate' => $startDate, 'endDate' => $endDate, 'apikey' => $this->publicKey]];
        } else {
            if ($location) {
                $query = ['query' => ['location' => $location, 'apikey' => $this->publicKey]];
            }
        }
        if ($query) {
            $response = $this->client->get('http://terminal2.expedia.com/x/activities/search?', $query);
            return $response->json();
        } else {
            return null;
        }
    }
}
