<?php

namespace App\Http\Livewire;

use App\Models\Invite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowElections extends Component
{

    private $user;
    public $elections;

    public function mount() {
        $this->user = Auth::guard('admin')->user();

        if (Invite::where('email', $this->user->email)->exists()) {
            $invites = Invite::where('email', $this->user->email)->get();
            foreach ($invites as $invite) {
                DB::table('election_user')->insert(
                    ['election_id' => $invite->election_id, 'user_id' => $this->user->id]
                );
                $invite->delete();
            }
        }

        $this->elections = Auth::user()->elections();
    }

    public function render()
    {
        return view('livewire.show-elections');
    }
}
