<?php

namespace App\Services;

use GuzzleHttp\Client;

class HttpService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function get($url, $options = [])
    {
        return $this->client->get($url, $options);
    }

    // Add methods for other HTTP request types as needed (e.g., post, put, delete)
}
