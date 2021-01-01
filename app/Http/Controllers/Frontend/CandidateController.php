<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CandidateController extends Controller
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
     * @param Role $role
     * @return Application|Factory|View|Response
     */
    public function create(Election $election, Role $role)
    {
        return view('dashboard.create.candidate')->with(['election' => $election])->with(['role' => $role]);
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
     * @param Candidate $candidate
     * @return Response
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Election $election
     * @param Role $role
     * @param Candidate $candidate
     * @return Application|Factory|View|Response
     */
    public function edit(Election $election, Role $role, Candidate $candidate)
    {
        return view('dashboard.edit.candidate')->with(['election' => $election])->with(['role' => $role])->with(['candidate' => $candidate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Candidate $candidate
     * @return Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Candidate $candidate
     * @return Response
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
