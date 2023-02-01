<?php

namespace App\Service;

use App\Exceptions\AuthenticationFailedException;
use App\Models\auth\GithubAuthenticationProvider;
use App\Models\auth\NetlifyAuthenticationProvider;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;

class NetlifyService implements AuthenticationServiceProvider
{
    public string $baseUrl;

    protected AuthenticationService $authenticationService;

    /**
     * @param AuthenticationService $authenticationService
     */
    public function __construct(AuthenticationService $authenticationService)
    {
        $this->baseUrl = env('NETLIFY_BASE_URL');
        $this->authenticationService = $authenticationService;
    }

    public function authorize(): \Symfony\Component\HttpFoundation\Response
    {
        session()->put('auth', 'netlify');
        $provider = new NetlifyAuthenticationProvider();
        return $this->authenticationService->getAuthorizationCode($provider);
    }

    /**
     * @throws AuthenticationFailedException
     */
    public function getUser(string $code)
    {
        $provider = new NetlifyAuthenticationProvider();
        $tokenResponse = $this->authenticationService->getAccessToken($provider, $code);
        $accessToken = $tokenResponse['access_token'];
        $userInfo = $this->get('/user', $accessToken);
        if ($user = User::find($userInfo['id'])) {
            return $user;
        }
        return User::create([
            'id' => $userInfo['id'],
            'display' => $userInfo['email'],
            'avatar_url' => $userInfo['avatar_url']
        ]);
    }

    public function get(string $endpoint, string $accessToken)
    {
        return Http::withToken($accessToken)->get("$this->baseUrl$endpoint")->json();
    }

}
