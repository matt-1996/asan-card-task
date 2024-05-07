<?php

namespace App\Services\HttpRequest;

use Illuminate\Support\Facades\Http;

class CustomRequest
{
    public static function get(string $url, string $proxy ,array $headers){
        return Http::getWithProxy($url, $proxy, $headers);
    }
}
