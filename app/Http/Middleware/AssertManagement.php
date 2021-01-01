<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssertManagement
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $election = $request->route('election');
        if($election->managedBy(Auth::user())) {
            return $next($request);
        }
        else {
            return abort(403);
        }
    }
}
