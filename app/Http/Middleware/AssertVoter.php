<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssertVoter
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

        $authorised = false;
        if (Auth::guard('admin')->check()) {
            if ($election->managedBy(Auth::user())) {
                $authorised = true;
            }
        }
        elseif (Auth::guard('voter')->check()) {
            if (Auth::guard('voter')->user()->election_id == $election->id) {
                $authorised = true;
            }
        }
        if($authorised) {
            return $next($request);
        }
        elseif (!$request->expectsJson()) {
            return redirect(route('frontend.login', ['election' => $election->slug]));
        }
        else {
            return abort(403);
        }
    }
}
