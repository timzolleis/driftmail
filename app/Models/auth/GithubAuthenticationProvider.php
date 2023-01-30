<?php

namespace App\Models\auth;

class GithubAuthenticationProvider extends AuthenticationProvider
{
    public function __construct()
    {
        $this->authUrl = env('GITHUB_AUTH_URL');
        $this->authTokenUrl = env('GITHUB_AUTH_TOKEN_URL');
        $this->authRedirectUrl = env('GITHUB_AUTH_REDIRECT_URI');
        $this->authClientId = env('GITHUB_AUTH_CLIENT_ID');
        $this->authClientSecret = env('GITHUB_AUTH_CLIENT_SECRET');
    }

}
