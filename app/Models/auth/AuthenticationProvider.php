<?php

namespace App\Models\auth;

abstract class AuthenticationProvider
{
    public string $authUrl;
    public string $authTokenUrl;
    public string $authRedirectUrl;
    public string $authClientId;
    public string $authClientSecret;


}
