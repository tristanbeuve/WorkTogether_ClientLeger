<?php

namespace App\Class;

use Unsplash\HttpClient;


class UnsplashClass{

    private $apiKey;
    private $httpClient;


    public function __construct()
    {
        $this->httpClient = HttpClient::class;
//        $token = HttpClient::$connection->generateToken('BTVFh-OTMoCRgguLxUrPvlrnoXZRh0gbLP11bmqy1gk');
        HttpClient::init([
            'applicationId' => '533972',
            'secret' => 'xVrZhJUr2t6XoI2Pr1bBPGoPj0w4MR-aihfWp1L-LU0',
            'callbackUrl' => 'https://your-application.com/oauth/callback',
            'utmSource' => 'PPE',
        ], [
            'access_token'=> 'urn:ietf:wg:oauth:2.0:oob',
            "expires_in"=>3600,
        ]);
    }


    public function searchPhotos(string $query)
    {
        $response = $this->httpClient->request('GET', '/photos/random', [
            'headers' => [
                'Authorization' => 'Client-ID ' . $this->apiKey,
            ],
            'query' => [
                'query' => $query,
            ],
        ]);

        // Traitement de la réponse
        $data = $response->toArray();

        return $data;
    }

}