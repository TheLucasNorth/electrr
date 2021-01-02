<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InviteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function store(Request $request, Election  $election)
    {
        if (!$request->user()->tokenCan('details')) {
            return response()->make('not authorised', 401);
        }
        $data = $request->validate([
           'email' => 'required|email:rfc'
        ]);

        // if user with the same email address already exists, then a management relationship is created between the user and the election
        if(User::where('email', $request->email)->exists()) {
            $user = User::where('email', $request->email)->first();
            // if user already manages election return 409
            if(Election::find($election->id)->managedBy($user)) {
                return response()->make('User already manages this election',409);
            }
            //else create management relationship
            DB::table('election_user')->insert(
                ['election_id' => $election->id, 'user_id' => $user->id]
            );
            return response()->noContent(201);
        }

        // if the email does not belong to a user, check if an invite already exists, and if it does return 409 Conflict
        if(Invite::where('email', $request->email)->where('election_id', $election->id)->exists()) {
            return response()->make('This email address has already been invited to this election', 409);
        }

        // if user and invite do not exist, create invite
        $invite = new Invite();
        $invite->email = $request->email;
        $invite->election_id = $election->id;
        $invite->save();
        return response()->noContent(201);

    }
}
