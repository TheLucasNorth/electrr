<?php

namespace App\Http\Middleware;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class VerifyExistence
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->has('election')) {
            Election::findOrFail($request->election);
        }

        if ($request->has('role')) {
            Role::findOrFail($request->role);
        }

        if ($request->has('candidate')) {
            Candidate::findOrFail($request->candidate);
        }

        return $next($request);
    }
}
