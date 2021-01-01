<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Role;
use Livewire\Component;

class NominationForm extends Component
{
    public $name;
    public $manifesto;
    public $image;
    public Role $role;
    public $uploadCount = 0;
    public $contact;
    public $information;

    protected $rules = [
        'name' => 'required',
        'image' => 'image|nullable',
        'information.*' => 'required',
    ];

    protected $messages = [
      'information.*.required' => 'This field is required.',
    ];

    public function mount(Role $role) {
        $contact = \App\Models\Election::find($role->election_id)->nomination_contact.';'.$role->nomination_contact;
        $this->contact = explode(';',$contact);
        foreach ($this->contact as $key => $value) {
            $this->information[$key] = null;
        }
    }

    public function render()
    {
        return view('livewire.nomination-form');
    }

    public function submitForm()
    {
        $this->validate();
        $candidate = new Candidate();
        $candidate->role_id = $this->role->id;
        $candidate->election_id = $this->role->election_id;
        $candidate->name = $this->name;
        $candidate->approved = false;
        $candidate->withdrawn = false;
        $candidate->manifesto = $this->manifesto;
        if ($this->image != null) {
            $candidate->image = $this->image->storePublicly('', 'images');
            $this->uploadCount++;
        }
        $candidate->contact = array_combine($this->contact, $this->information);
        $candidate->save();
        session()->flash('success', 'Nomination submitted successfully.');
        return redirect(route('frontend.nominations', ['election' => \App\Models\Election::find($this->role->election_id)->slug]));
    }
}
