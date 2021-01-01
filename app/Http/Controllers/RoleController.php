<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Role;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class RoleController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, Election $election)
    {
        if (!$request->user()->tokenCan('roles')) {
            return response()->json(['message' => 'not authorised'], 401);
        }

        $data = $request->validate([
            'name' => 'required',
            'description' => '',
            'voting_open' => 'required|date',
            'voting_close' => 'required|date',
            'nominations_open' => 'date',
            'nominations_close' => 'date',
            'nominations' => 'required|boolean',
            'ranked' => 'required|boolean',
            'seats' => 'required|integer',
            'ron' => 'required|boolean',
            'nomination_contact' => '',
            'custom' => ''
        ]);
        $data['election_id'] = $election->id;
        $data['slug'] = Str::lower(Str::random(5));
        return Role::create($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Election $election
     * @param Role $role
     * @return Response
     */
    public function update(Request $request, Election $election, Role $role)
    {
        if (!$request->user()->tokenCan('roles')) {
            return response()->json(['message' => 'not authorised'], 401);
        }

        $data = $request->validate([
            'name' => 'required',
            'description' => '',
            'voting_open' => 'required|date',
            'voting_close' => 'required|date',
            'nominations_open' => 'required|date',
            'nominations_close' => 'required|date',
            'nominations' => 'required|boolean',
            'ranked' => 'required|boolean',
            'seats' => 'required|integer',
            'ron' => 'required|boolean',
            'nomination_contact' => '',
            'custom' => ''
        ]);

        $role->name = $request->name;
        $role->description = $request->description;
        $role->voting_open = $request->voting_open;
        $role->voting_close = $request->voting_close;
        $role->nominations_open = $request->nominations_open;
        $role->nominations_close = $request->nominations_close;
        $role->nominations = $request->nominations;
        $role->ranked = $request->ranked;
        $role->seats = $request->seats;
        $role->ron = $request->ron;
        $role->nomination_contact = $request->nomination_contact;
        $role->custom = $request->custom;
        $role->save();
        return response()->noContent(204);
    }
}
