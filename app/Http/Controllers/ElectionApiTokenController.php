<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class ElectionApiTokenController extends Controller
{
    /**
     * Show the user API token screen.
     *
     * @param Request $request
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index(Request $request)
    {
        return view('dashboard.edit.api', [
            'request' => $request,
            'user' => $request->user(),
            'election' => $request->election
        ]);
    }
}
