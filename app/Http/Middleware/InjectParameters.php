<?php

namespace App\Http\Middleware;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class InjectParameters
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
            URL::defaults(['election' => $request->election, 'role' => $request->role, 'candidate' => $request->candidate]);

        return $next($request);
    }
}
