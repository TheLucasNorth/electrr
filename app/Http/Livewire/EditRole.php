<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;

class EditRole extends Component
{

    public $role;
    public $name;
    public $election;
    public $description;
    public $seats;
    public $votingOpen;
    public $votingClose;
    public $nominations;
    public $nominationsOpen;
    public $nominationsClose;
    public $ron;
    public $ranked;
    public $information;
    public $vOpenID;
    public $vCloseID;
    public $nOpenID;
    public $nCloseID;


    public function mount(\App\Models\Election $election, Role $role) {
        $this->election = $election;
        $this->role = $role;

        $this->fill($role);
        $this->votingOpen = $role->voting_open->format("d-m-Y H:i");
        $this->votingClose = $role->voting_close->format("d-m-Y H:i");
        $this->nominationsOpen = $role->nominations_open->format("d-m-Y H:i");
        $this->nominationsClose = $role->nominations_close->format("d-m-Y H:i");
        $this->information = $role->nomination_contact;

        $this->vOpenID = 'a'.Str::random(5);
        $this->vCloseID = 'a'.Str::random(5);
        $this->nOpenID = 'a'.Str::random(5);
        $this->nCloseID = 'a'.Str::random(5);
        $this->nominations = $role->nominations ? true : false;
        $this->ron = $role->ron ? true : false;
        $this->ranked = $role->ranked ? true : false;

    }

    protected $rules = [
        'name' => 'required',
        'votingOpen' => 'required|date',
        'votingClose' => 'required|date',
        'nominationsOpen' => 'required_if:nominations,true|date|nullable',
        'nominationsClose' => 'required_if:nominations,true|date|nullable',
        'nominations' => 'required|boolean',
        'ranked' => 'nullable|boolean',
        'seats' => 'required|integer',
        'ron' => 'nullable|boolean'
    ];

    public function render()
    {
        return view('livewire.edit-role');
    }

    public function submitForm() {
        $this->validate();
        $role = $this->role;
        $role->name = $this->name;
        $role->seats = $this->seats;
        $role->description = $this->description;
        $role->voting_open = $this->votingOpen;
        $role->voting_close = $this->votingClose;
        $role->nominations = $this->nominations;
        $role->nominations_open = $this->nominationsOpen;
        $role->nominations_close = $this->nominationsClose;
        $role->nomination_contact = $this->information;
        $role->ranked = $this->ranked;
        $role->ron = $this->ron;
        $role->save();
        return $this->redirect(route('election.edit', ['election' => $this->election->slug]));
    }
}
