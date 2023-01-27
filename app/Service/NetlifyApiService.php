<?php

namespace App\Service;

use App\Exceptions\NetlifyApiException;
use App\Models\custom\NetlifyAuthentication;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class NetlifyApiService
{
    protected string $baseUrl;
    protected NetlifyAuthentication $authentication;

    public function __construct(NetlifyAuthentication $authentication)
    {
        $this->baseUrl = env('NETLIFY_BASE_URL');
        $this->authentication = $authentication;
    }

    public function get(string $endpoint): array{
        $response = Http::withToken($this->authentication->getAccessToken())->get("$this->baseUrl/$endpoint");
        $response->onError(/**
         * @throws NetlifyApiException
         */ function (Response $response){
            $responseArray = $response->json();
            throw new NetlifyApiException($responseArray['error_description']);
        });
        return $response->json();
    }





}
