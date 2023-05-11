<?php

namespace App\Services\SocialMedia;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

abstract class SocialMediaService
{
    abstract public function request($method, $endpoint, $params = []);

    abstract public function sharePost($data);
}
