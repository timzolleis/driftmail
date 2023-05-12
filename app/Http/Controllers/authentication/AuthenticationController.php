<?php

namespace App\Http\Controllers\authentication;

use App\Service\AuthenticationService;
use App\Service\GithubService;
use App\Service\NetlifyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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

    public function index()
    {
        return Inertia::render('Login');
    }

    public function authorize(Request $request, string $provider)
    {
        if ($provider === 'github') {
            return (new GithubService($this->authenticationService))->authorize();
        }
        if ($provider === 'netlify') {
            return (new NetlifyService($this->authenticationService))->authorize();
        }
        return to_route('login.view');
    }

    public function callback(Request $request, string $provider)
    {
        $code = $request->query('code');
        session()->flush();
        $service = null;
        if ($provider === "github") {
            $service = new GithubService($this->authenticationService);
        }
        if ($provider === "netlify") {
            $service = new NetlifyService($this->authenticationService);
        }
        if ($service !== null) {
            $user = $service->getUser($code);
            Auth::loginUsingId($user->id);
            if (Auth::check()) {
                return redirect('/');
            }
        }
        return to_route('login.view');
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


}
