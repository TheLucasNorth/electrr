<?php

namespace App\Http\Controllers;

use App\Models\Ballot;
use App\Models\Election;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BallotController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Election $election
     * @param Role $role
     * @return Response
     */
    public function store(Request $request, Election $election, Role $role)
    {
        if (!$request->user()->tokenCan('ballots')) {
            return response()->json(['message' => 'not authorised'], 401);
        }

        $data = $request->validate([
            'vote.*' => 'nullable|integer',
            'vid' => 'required',
        ]);
        $verify = Str::random(32);
        ksort($data['vote']);
        $ballot = implode(' ', $data['vote']);
        $vote = implode(" ", [1, $ballot, 0, '#', $verify]);

        $userId = $data['vid'];

        if ($saveVote = Ballot::updateOrCreate(
            ['voter_id' => $userId, 'election_id' => $election->id, 'role_id' => $role->id],
            ['vote' => encrypt($vote)]
        )) {
            return response()->json(['verify' => $verify], 201);
        } else {
            return response()->noContent(500);
        }
    }
}
