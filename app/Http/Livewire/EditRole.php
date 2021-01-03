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
    public $voting_open;
    public $voting_close;
    public $nominations;
    public $nominations_open;
    public $nominations_close;
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
        'voting_open' => 'required|date',
        'voting_close' => 'required|date',
        'nominations_open' => 'required_if:nominations,true|date|nullable',
        'nominations_close' => 'required_if:nominations,true|date|nullable',
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
        $role->voting_open = Carbon::createFromFormat('d-m-Y H:i',$this->voting_open);
        $role->voting_close = Carbon::createFromFormat('d-m-Y H:i',$this->voting_close);
        $role->nominations = $this->nominations;
        if ($this->nominations) {
            $role->nominations_open = Carbon::createFromFormat('d-m-Y H:i',$this->nominations_open);
            $role->nominations_close = Carbon::createFromFormat('d-m-Y H:i',$this->nominations_close);
        }
        else {
            $role->nominations_open = null;
            $role->nominations_close = null;
        }
        $role->nomination_contact = $this->information;
        $role->ranked = $this->ranked;
        $role->ron = $this->ron;
        $role->save();
        return $this->redirect(route('election.edit', ['election' => $this->election->slug]));
    }
}
