<?php

namespace App\Service;

use App\Exceptions\AuthenticationFailedException;
use App\Models\auth\AuthenticationProvider;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthenticationService
{
    public function getAuthorizationCode(AuthenticationProvider $provider): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route($provider->authUrl, [
            'client_id' => $provider->authClientId,
            'response_type' => 'code',
            'redirect_uri' => $provider->authRedirectUrl
        ]);
    }

    public function getAccessToken(AuthenticationProvider $provider, string $code)
    {
        $response = Http::asForm()->acceptJson()->post($provider->authTokenUrl, [
            'code' => $code,
            'client_id' => $provider->authClientId,
            'grant_type' => 'authorization_code',
            'client_secret' => $provider->authClientSecret,
            'redirect_uri' => $provider->authRedirectUrl
        ]);
        $response->onError(/**
         * @throws AuthenticationFailedException
         */ function (Response $response) {
            $exception = $response->json();
            throw new AuthenticationFailedException($exception);
        });
        return $response;
    }


}
