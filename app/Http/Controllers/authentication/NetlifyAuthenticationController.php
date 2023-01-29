<?php

namespace App\Http\Controllers\authentication;

use App\Exceptions\AuthenticationFailedException;
use App\Service\NetlifyAuthenticationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class NetlifyAuthenticationController extends BaseController
{

    protected NetlifyAuthenticationService $netlifyAuthenticationService;

    public function __construct(NetlifyAuthenticationService $netlifyAuthenticationService)
    {
        $this->netlifyAuthenticationService = $netlifyAuthenticationService;
    }


    public function index()
    {
        return Inertia::render('Login');

    }

    public function redirectToNetlify()
    {
        $netlify_auth_url = env('NETLIFY_AUTH_URL');
        $client_id = env('NETLIFY_AUTH_CLIENT_ID');
        $redirect_uri = env('NETLIFY_AUTH_REDIRECT_URI');
        $responseType = "code";
        return Inertia::location("$netlify_auth_url?client_id=$client_id&response_type=$responseType&redirect_uri=$redirect_uri");
    }

    /**
     * @throws \Exception
     */
    public function callBack(Request $request)
    {
        $code = $request->query('code');
        if (!$code) {
            throw new \Exception('Code not present');
        }
        try {
            $authentication = $this->netlifyAuthenticationService->retrieveAccessToken($code);
            $user = $this->netlifyAuthenticationService->getUserData($authentication);
            Auth::loginUsingId($user->id);
            return redirect('/');
        } catch (AuthenticationFailedException $e) {
            return redirect('/login');
        }
    }


}
