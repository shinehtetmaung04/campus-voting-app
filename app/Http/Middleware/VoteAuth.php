<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VoteAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('login_code')) {
            // remember where the user came from
            session(['redirect_after_login' => url()->previous()]);
            return redirect('/login');
        }

        return $next($request);
    }
}
