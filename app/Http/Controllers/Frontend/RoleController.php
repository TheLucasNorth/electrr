<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Election $election
     * @return Application|Factory|View|Response
     */
    public function create(Election $election)
    {
        return view('dashboard.create.role')->with(['election' => $election]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Election $election
     * @param Role $role
     * @return Application|Factory|View|Response
     */
    public function show(Election $election, Role $role)
    {
        return view('voting.role')->with('election', $election)->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Election $election
     * @param Role $role
     * @return Application|Factory|View|Response
     */
    public function edit(Election $election, Role $role)
    {
        return view('dashboard.edit.role')->with(['election' => $election])->with(['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Role $role
     * @return Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
