<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class CheckRule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    // my_NOTE: to make the middleware dynamic , put an array as a argument in the last  , 
    // and in the usage : ::middleware('role:admin,super-admin)
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (!$user) return Redirect::route('login');
        if ($user->role != 'admin' &&  $user->role != 'super-admin') abort(403);
        return $next($request);
    }
}
