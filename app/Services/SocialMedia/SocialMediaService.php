<?php

namespace App\Services\SocialMedia;

abstract class SocialMediaService
{
    abstract public function fetchData();

    abstract public function sharePost($data);
}
