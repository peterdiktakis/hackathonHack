<?php namespace App\Helpers;

use Eher\OAuth;

class YelpHelper {

    private $CONSUMER_KEY = NULL;
    private $CONSUMER_SECRET = NULL;
    private $TOKEN = NULL;
    private $TOKEN_SECRET = NULL;
    private $API_HOST = 'api.yelp.com';
    private $DEFAULT_TERM = 'dinner';
    private $DEFAULT_LOCATION = 'San Francisco, CA';
    private $SEARCH_LIMIT = 6;
    private $SEARCH_PATH = '/v2/search/';
    private $BUSINESS_PATH = '/v2/business/';

    protected static $instance = null;

    protected function __construct()
    {
        $this->CONSUMER_KEY = $_ENV['CONSUMER_KEY'];
        $this->CONSUMER_SECRET = $_ENV['CONSUMER_SECRET'];
        $this->TOKEN = $_ENV['TOKEN'];
        $this->TOKEN_SECRET = $_ENV['TOKEN_SECRET'];
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
     * Makes a request to the Yelp API and returns the response
     *
     * @param    $host    The domain host of the API
     * @param    $path    The path of the APi after the domain
     * @return   The JSON response from the request
     */
    public function request($host, $path) {
        $unsigned_url = "http://" . $host . $path;
        // Token object built using the OAuth library
        $token = new OAuth\Token($this->TOKEN, $this->TOKEN_SECRET);
        // Consumer object built using the OAuth library
        $consumer = new OAuth\Consumer($this->CONSUMER_KEY, $this->CONSUMER_SECRET);
        // Yelp uses HMAC SHA1 encoding
        $signature_method = new OAuth\HmacSha1();
        $oauthrequest = OAuth\Request::from_consumer_and_token(
            $consumer,
            $token,
            'GET',
            $unsigned_url
        );

        // Sign the request
        $oauthrequest->sign_request($signature_method, $consumer, $token);

        // Get the signed URL
        $signed_url = $oauthrequest->to_url();

        // Send Yelp API Call
        $ch = curl_init($signed_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    public function search($term, $location, $coordinates) {
        $url_params = array();
        $url_params['term'] = $term ?: $this->DEFAULT_TERM;
        $url_params['location'] = $location?: $this->DEFAULT_LOCATION;
        $url_params['limit'] = $this->SEARCH_LIMIT;
        $url_params['cll'] = $coordinates;
        $search_path = $this->SEARCH_PATH . "?" . http_build_query($url_params);
        return $this->request($this->API_HOST, $search_path);
    }
}