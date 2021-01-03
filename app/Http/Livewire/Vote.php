<?php

namespace App\Http\Livewire;

use App\Models\Ballot;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Vote extends Component
{

    public $ranked;
    public $ron;
    public $candidates;
    public $vid;
    public $voted;
    public $ballot;
    public $verify = null;
    public $active = true;
    public $eid;
    public $rid;
    public $shuffle;
    public $validOrder;

    public function mount(Role $role) {
        $this->ranked = $role->ranked;
        $this->ron = $role->ron;
        $this->candidates = $this->getCandidates($role);
        if (Auth::guard('voter')->check()) {
            $this->vid = 'v'.Auth::id();
        }
        elseif (Auth::guard('admin')->check()) {
            $this->vid = 'u'.Auth::id();
        }
        if (Ballot::where('role_id', $role->id)->where('voter_id', $this->vid)->exists()) {
            $this->voted = true;
        }
        $this->eid = $role->election_id;
        $this->rid = $role->id;
        $this->shuffle = $role->election->shuffle_candidates;
        if (session()->get('disableShuffle')) {
            $this->shuffle = false;
        }
        $this->validOrder = [];
        foreach ($this->candidates as $candidate) {
            $this->validOrder[] = $candidate->order;
        }
        if ($this->ron) {
            $this->validOrder[] = 1;
        }
    }

    public function render()
    {
        return view('livewire.vote');
    }

    public function getCandidates($role) {
        $candidates = $role->activeCandidates();
        if ($this->ron) {
            foreach ($candidates as $candidate) {
                $candidate->order++;
            }
        }
        return $candidates;
    }

    public function submitForm() {
        $this->active = false;
        $verify = Str::random(32);
        ksort($this->ballot);
        foreach ($this->ballot as $key => $value) {
            if (!in_array($value, $this->validOrder)) {
                unset($this->ballot[$key]);
            }
        }
        $vote = implode(' ', $this->ballot);
        $string = implode(' ', [1, $vote, 0, '#', $verify]);
        Ballot::updateOrCreate(
            ['voter_id' => $this->vid, 'election_id' => $this->eid, 'role_id' => $this->rid],
            ['vote' => encrypt($string)]
        );
        $this->verify = $verify;
    }

}
