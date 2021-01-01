<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Role;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddCandidate extends Component
{

    use WithFileUploads;

    public $name;
    public $manifesto;
    public $image;
    public \App\Models\Election $election;
    public Role $role;
    public $uploadCount = 0;

    public function render()
    {
        return view('livewire.add-candidate');
    }

    protected $rules = [
        'name' => 'required',
        'image' => 'image|nullable',
    ];

    public function submitForm()
    {
        $this->validate();
        $candidate = new Candidate();
        $candidate->role_id = $this->role->id;
        $candidate->election_id = $this->election->id;
        $candidate->name = $this->name;
        $candidate->approved = true;
        $candidate->order = $this->role->candidates()->where('approved', true)->count()+1;
        $candidate->withdrawn = false;
        $candidate->manifesto = $this->manifesto;
        if ($this->image != null) {
            $candidate->image = $this->image->storePublicly('', 'images');
            $this->uploadCount++;
        }
        $candidate->save();
        return $this->redirect(route('role.edit', ['election' => $this->election->slug, 'role' => $this->role->id]));
    }
}
