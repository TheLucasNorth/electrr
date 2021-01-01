<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Election;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ElectionController extends Controller
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
     * @return Response
     */
    public function create()
    {
        //
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
     * @return Response
     */
    public function show(Election $election)
    {
        return view('voting.home')->with(['election' => $election]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Election $election
     * @return Application|Factory|View|Response
     */
    public function edit(Election $election)
    {
        return view('dashboard.edit.election')->with(['election' => $election]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Election $election
     * @return Response
     */
    public function update(Request $request, Election $election)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Election $election
     * @return Response
     */
    public function destroy(Election $election)
    {
        //
    }
}
