<?php

namespace App\Http\Middleware;

use App\Enums\UserType;
use Closure;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        if ($request->user()->type != $type) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
