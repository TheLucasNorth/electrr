<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Illuminate\Support\Str;
use Livewire\Component;

class AddRole extends Component
{

    public $name;
    public \App\Models\Election $election;
    public $description;
    public $seats;
    public $votingOpen;
    public $votingClose;
    public $nominations = false;
    public $nominationsOpen;
    public $nominationsClose;
    public $ron = false;
    public $ranked = false;
    public $information;
    public $vOpenID;
    public $vCloseID;
    public $nOpenID;
    public $nCloseID;


    public function mount() {
        $this->vOpenID = 'a'.Str::random(5);
        $this->vCloseID = 'a'.Str::random(5);
        $this->nOpenID = 'a'.Str::random(5);
        $this->nCloseID = 'a'.Str::random(5);
    }

    public function render()
    {
        return view('livewire.add-role');
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

    public function submitForm() {
        $data = $this->validate();
        $role = new Role();
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
        $role->election_id = $this->election->id;
        $role->slug = Str::random(5);
        $role->save();
        return $this->redirect('/dashboard/elections/' . $this->election->slug . '/roles/' . $role->id);
    }

}
