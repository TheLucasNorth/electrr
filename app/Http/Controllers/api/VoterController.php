<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Jobs\FactoryVoters;
use App\Models\Role;
use App\Models\Voter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request, Election $election)
    {
        if (!$request->user()->tokenCan('voters')) {
            return response()->json(['message' => 'not authorised'], 401);
        }

        return $election->voters;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Election $election
     * @return JsonResponse
     */
    public function store(Request $request, Election $election)
    {
        if (!$request->user()->tokenCan('voters')) {
            return response()->json(['message' => 'not authorised'], 401);
        }
        $data = $request->validate([
            'email' => 'email:rfc|nullable'
        ]);
        $voter = new Voter();
        $voter->election_id = $election->id;
        $voter->username = $voter->safeUsername($election->id);
        $password = $voter->password();
        $voter->password_plain = $password;
        $voter->password = Hash::make($password);
        $voter->email = $data['email'] ?? 'no-email';
        $voter->save();
        return response()->json($voter)->setStatusCode(201);
    }

    /**
     * Bulk store voters.
     *
     * @param Request $request
     * @param Election $election
     * @return Response
     */
    public function storeFactory(Request $request, Election $election)
    {
        if (!$request->user()->tokenCan('voters')) {
            return response()->json(['message' => 'not authorised'], 401);
        }
        $data = $request->validate([
            'quantity' => 'required|integer'
        ]);
        FactoryVoters::dispatch($election, $data['quantity']);
        return response()->make('Accepted, please wait.', 202);
    }

    public function show(Request $request, Election $election, Role $role, Voter $voter) {
        if (!$request->user()->tokenCan('voters')) {
            return response()->json(['message' => 'not authorised'], 401);
        }
        return $voter;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        if (!$request->user()->tokenCan('voters')) {
            return response()->json(['message' => 'not authorised'], 401);
        }
        Voter::find($id)->delete();
        return response()->make('Success', 200);
    }
}
