<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (!session()->has('user') || !session()->has('authentication')) {
            return redirect('/login');
        }
        return $next($request);
    }
}
