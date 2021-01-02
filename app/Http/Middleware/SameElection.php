<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SameElection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->id != $request->election->id) {
            return response()->json(['message' => 'not authorised'], 401);
        }

        if ($request->role) {
            if ($request->role->election_id != $request->election->id) {
                return response()->json(['message' => 'not authorised'], 401);
            }
        }

        if ($request->candidate) {
            if ($request->candidate->election_id != $request->election->id) {
                return response()->json(['message' => 'not authorised'], 401);
            }
        }

        if ($request->voter) {
            if ($request->candidate->election_id != $request->election->id) {
                return response()->json(['message' => 'not authorised'], 401);
            }
        }


        return $next($request);
    }
}
