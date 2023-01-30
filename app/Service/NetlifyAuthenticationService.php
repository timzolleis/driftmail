<?php

namespace App\Service;

use App\Exceptions\AuthenticationFailedException;
use App\Models\custom\NetlifyAuthConfiguration;
use App\Models\custom\NetlifyAuthentication;
use App\Models\custom\NetlifyUser;
use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class NetlifyAuthenticationService
{

    public function retrieveAccessToken(string $code): NetlifyAuthentication
    {
        $configuration = $this->getNetlifyConfiguration();
        $response = Http::asForm()->post($configuration->getAuthenticationTokenUrl(), [
            'code' => $code,
            'client_id' => $configuration->getClientId(),
            'grant_type' => "authorization_code",
            'client_secret' => $configuration->getClientSecret(),
            'redirect_uri' => $configuration->getRedirectUri()]);

        $response->onError(/**
         * @throws AuthenticationFailedException
         */ function (Response $response) {
            $exception = $response->json();
            throw new AuthenticationFailedException($exception['error_description']);
        });
        return new NetlifyAuthentication($response['access_token'], $response['refresh_token']);
    }


    public function getNetlifyConfiguration()
    {
        $netlify_auth_url = env('NETLIFY_AUTH_URL');
        $netlify_token_url = env('NETLIFY_AUTH_TOKEN_URL');
        $client_id = env('NETLIFY_AUTH_CLIENT_ID');
        $client_secret = env('NETLIFY_AUTH_CLIENT_SECRET');
        $redirect_uri = env('NETLIFY_AUTH_REDIRECT_URI');
        return new NetlifyAuthConfiguration($netlify_auth_url, $netlify_token_url, $redirect_uri, $client_id, $client_secret);
    }


    public function getUserData(NetlifyAuthentication $authentication): NetlifyUser
    {
        $apiService = new NetlifyApiService($authentication);
        $response = $apiService->get('user');
        if ($user = NetlifyUser::find($response['id'])) {
            return $user;
        }
        return NetlifyUser::create([
            'id' => $response['id'],
            'email' => $response['email'],
            'avatar_url' => $response['avatar_url'],
        ]);
    }


}
