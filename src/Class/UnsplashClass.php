<?php

namespace App\Class;

use Unsplash\HttpClient;

class UnsplashClass{

    public function __construct()
    {
        HttpClient::init([
            'applicationId' => '533972',
            'secret' => 'xVrZhJUr2t6XoI2Pr1bBPGoPj0w4MR-aihfWp1L-LU0',
            'callbackUrl' => 'https://your-application.com/oauth/callback',
            'utmSource' => 'PPE',
        ]);
    }


}