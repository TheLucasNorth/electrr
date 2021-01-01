<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return Auth::user()->elections();
        }
        else {
            return response()->noContent(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => 'required|alpha_dash|unique:elections',
            'name' => 'required',
            'description' => '',
            'imprint' => '',
            'nominations' => 'boolean',
            'shuffle_manifestos' => 'boolean',
            'shuffle_candidates' => 'boolean',
            'description_home' => 'boolean',
            'description_nomination' => 'boolean',
            'nomination_contact' => '',
            'custom' => ''
        ]);
        $data['token'] = Str::random(10);
        $data['user_id'] = Auth::id();
        // created election is returned as JSON, which allows getting id and returns HTTP 201
        return Election::create($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  string  $slug
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        if (!$request->user()->tokenCan('details')) {
            return response()->json(['message' => 'not authorised'], 401);
        }
        $election = $request->route('election');
        $data = $request->validate([
            'name' => 'required',
            'description' => '',
            'imprint' => '',
            'nominations' => 'boolean',
            'shuffle_manifestos' => 'boolean',
            'shuffle_candidates' => 'boolean',
            'description_home' => 'boolean',
            'description_nomination' => 'boolean',
            'nomination_contact' => '',
            'custom' => ''
        ]);
        $election->name = $request->name;
        $election->description = $request->description;
        $election->imprint = $request->imprint;
        $election->nominations = $request->nominations;
        $election->shuffle_manifestos = $request->shuffle_manifestos;
        $election->shuffle_candidates = $request->shuffle_candidates;
        $election->description_home = $request->description_home;
        $election->description_nomination = $request->description_nomination;
        $election->nomination_contact = $request->nomination_contact;
        $election->custom = $request->custom;
        $election->save();
        return response()->noContent();
    }

    public function turnout(Election $election, $token) {
        if ($token === $election->token) {
            return $election->turnout();
        }
        else {
            return abort(403);
        }
    }
}
