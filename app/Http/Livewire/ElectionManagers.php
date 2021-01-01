<?php

namespace App\Http\Livewire;

use App\Models\Election;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ElectionManagers extends Component
{
    public $managers = null;
    public $message;
    public $email;
    public $election;

    public function mount(Election $election) {
        $this->election = $election;
    }

    public function render()
    {
        $this->managers = Election::find($this->election->id)->managers;
        return view('livewire.election-managers');
    }

    public function remove($id) {
        $this->election->managers()->detach($id);
        $this->message = "Manager removed.";
    }

    public function submitForm() {
        $data = $this->validate([
            'email' => 'required|email:rfc'
        ]);

        // verify that auth user is the owner of the election
        $election = $this->election;
        if(!Auth::guard('admin')->user()->is($election->owner)) {
            $this->message = "You are not permitted to add managers to this election.";
            $this->email = null;
            return false;
        }

        // if user with the same email address already exists, then a management relationship is created between the user and the election
        if(User::where('email', $this->email)->exists()) {
            $user = User::where('email', $this->email)->first();
            // if user already manages election return 409
            if($this->election->managedBy($user)) {
                $this->message = "A user with this email address already manages this election.";
                $this->email = null;
                return true;
            }
            //else create management relationship
            DB::table('election_user')->insert(
                ['election_id' => $this->election->id, 'user_id' => $user->id]
            );
            $this->message = "This user has been added to the election.";
            $this->email = null;
            return true;
        }

        // if the email does not belong to a user, check if an invite already exists, and if it does return 409 Conflict
        if(Invite::where('email', $this->email)->where('election_id', $this->election->id)->exists()) {
            $this->message = 'This email address has already been invited to this election.';
            $this->email = null;
            return false;
        }

        // if user and invite do not exist, create invite
        $invite = new Invite();
        $invite->email = $this->email;
        $invite->election_id = $this->election->id;
        $invite->save();
        $this->message = "Invite sent.";
        $this->email = null;
    }


}
