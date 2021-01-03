<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CandidateController extends Controller
{

    public function index(Request $request, Election $election, Role $role) {
        if (!$request->user()->tokenCan('candidates')) {
            return response()->json(['message' => 'not authorised'], 401);
        }
        return $role->candidates;
    }

    public function show(Request $request, Election $election, Role $role, Candidate $candidate) {
        if (!$request->user()->tokenCan('candidates')) {
            return response()->json(['message' => 'not authorised'], 401);
        }
        return $candidate;
    }

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
        if (!$request->user()->tokenCan('candidates')) {
            return response()->json(['message' => 'not authorised'], 401);
        }

        $data = $request->validate([
            'name' => 'required',
            'manifesto' => '',
            'approved' => 'boolean',
            'image' => '',
            'custom' => '',
            'contact' => '',
        ]);
        $data['election_id'] = $election->id;
        $data['role_id'] = $role->id;
        if ($data['approved'] === true) {
            $data['order'] = $role->candidates()->where('approved', true)->count()+1;
        }
        // created election is returned as JSON, which allows getting id and returns HTTP 201
        return Candidate::create($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Candidate $candidate
     * @param Election $election
     * @param Role $role
     * @return Response
     */
    public function update(Request $request, Election $election, Role $role, Candidate $candidate)
    {
        if (!$request->user()->tokenCan('candidates')) {
            return response()->json(['message' => 'not authorised'], 401);
        }

        $data = $request->validate([
            'name' => 'required',
            'manifesto' => '',
            'approved' => 'boolean|nullable',
            'withdrawn' => 'boolean',
            'image' => '',
            'custom' => '',
            'contact' => ''
        ]);
        if ($data['approved'] === true && !$candidate->approved) {
            $data['order'] = $role->candidates()->where('approved', true)->count()+1;
        }
        // this overwrite is essential. It cannot be possible to de-approve an already approved candidate, this will break results generation.Use the withdraw function instead.
        if ($candidate->approved) {
            $data['approved'] = true;
        }
        $candidate->fill($data);
        return response()->make('Candidate Updated', 202);
    }
}
