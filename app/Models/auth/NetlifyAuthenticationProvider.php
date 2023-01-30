<?php

namespace App\Models\auth;

class NetlifyAuthenticationProvider extends AuthenticationProvider
{
    public function __construct()
    {
        $this->authUrl = env('NETLIFY_AUTH_URL');
        $this->authTokenUrl = env('NETLIFY_AUTH_TOKEN_URL');
        $this->authRedirectUrl = env('NETLIFY_AUTH_REDIRECT_URI');
        $this->authClientId = env('NETLIFY_AUTH_CLIENT_ID');
        $this->authClientSecret = env('NETLIFY_AUTH_CLIENT_SECRET');
    }

    public function getAccessToken(string $code)
    {
        // TODO: Implement getAccessToken() method.
    }
    public function getAuthorizationCode()
    {
        // TODO: Implement getAuthorizationCode() method.
    }

}
