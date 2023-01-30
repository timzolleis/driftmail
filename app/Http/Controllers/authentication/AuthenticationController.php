<?php

namespace App\Http\Controllers\authentication;

use App\Service\AuthenticationService;
use App\Service\GithubService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController
{

    protected AuthenticationService $authenticationService;

    /**
     * @param AuthenticationService $authenticationService
     */
    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }
    public function authorize(Request $request)
    {
        $provider = $request->query('provider');
        if ($provider === 'github') {
            $service = new GithubService($this->authenticationService);
            return $service->authorize();
        }
        return redirect('/login');
    }
    public function callback(Request $request)
    {
        $provider = session()->get('auth');
        $code = $request->query('code');
        session()->flush();
        if ($provider === "github") {
            $service = new GithubService($this->authenticationService);
            $user = $service->getUser($code);
            Auth::loginUsingId($user->id);
            if (Auth::check()) {
                return redirect('/');
            }
        }
        return redirect('/login');
    }


}
