<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NominationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response|void
     */
    public function index(Election $election)
    {
        if ($election->nominations) {
            $roles = [];
            foreach ($election->roles()->where('nominations', true)->get() as $role) {
                if (Carbon::parse($role->nominations_open)->lte(Carbon::now()) && Carbon::parse($role->nominations_close)->gte(Carbon::now())) {
                    $roles[] = $role;
                }
            }
            return view('voting.nominations')->with('election', $election)->with('roles', $roles);
        }
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Election $election
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Election $election, Role $role)
    {
        return view('voting.nominate')->with('election', $election)->with('role', $role);
    }
}
