<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\Voter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Election $election
     * @return Application|Factory|View|Response
     */
    public function index(Election $election)
    {
        return view('dashboard.voters')->with(['election' => $election]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Election $election
     * @return Application|Factory|View|Response
     */
    public function indexEmail(Election $election)
    {
        return view('dashboard.emailVoters')->with(['election' => $election]);
    }

    public function login(Election $election, Request $request) {

        if(Auth::check()) {
            Auth::logout();
        }

        if (Auth::guard('voter')->attempt(['username' => $request->username, 'password' => $request->password, 'election_id' => $election->id])) {
            $request->session()->regenerate();
            return redirect()->intended(route('frontend.home', ['election'=>$election->slug]));
        }

        return back()->withErrors([
            'VotingCode' => 'The provided credentials do not match our records.',
        ]);
    }

    public function linkLogin(Election $election, $username, $password, Request $request) {

        if(Auth::check()) {
            Auth::logout();
        }

        if (Auth::guard('voter')->attempt(['username' => $username, 'password' => $password, 'election_id' => $election->id])) {
            $request->session()->regenerate();
            return redirect()->route('frontend.home', ['election'=>$election->slug]);
        }

        return redirect(route('frontend.login'))->withErrors([
            'VotingCode' => 'The provided credentials do not match our records.',
        ]);
    }

}
