<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (! Auth::check()) {
            return redirect()->route('login-form');
        }

        $user = Auth::user();

        if (! in_array($user->role, $roles)) {
            return redirect()->back();
        }

        return $next($request);
    }
}
