<?php

namespace GoldbachAlgorithms\AIG;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GoldbachAlgorithms\AIG\Address;
use GoldbachAlgorithms\AIG\ViaCEP\Constants;

class ViaCEP
{
    protected $http;

    public function __construct(ClientInterface $http = null)
    {
        $this->http = $http ?: new Client();
    }

    public function findByZipCode($zipCode)
    {
        $url = sprintf(Constants::BASE_URL, $zipCode);

        $response = $this->http->request(Constants::METHOD, $url);

        $attributes = json_decode($response->getBody(), true);

        if (
            array_key_exists(Constants::ERROR, $attributes) &&
            $attributes[Constants::ERROR] === true
        ) {
            return new Address();
        }

        $attributes[Constants::SOURCE] = Constants::SOURCE_NAME;

        return new Address($attributes);
    }
}
