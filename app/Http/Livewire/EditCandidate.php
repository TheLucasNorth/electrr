<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Role;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditCandidate extends Component
{
    use WithFileUploads;

    public $name;
    public $manifesto;
    public $image;
    public \App\Models\Election $election;
    public Role $role;
    public $uploadCount = 0;
    public $approve;
    public $candidate;
    public $removeImage;
    public $withdraw;
    public $contact;

    public function mount(Candidate $candidate)
    {
        $this->candidate = $candidate;
        $this->fill($candidate);
        $this->image = null;
        $this->withdraw = $candidate->withdrawn ? true : false;
    }

    public function render()
    {
        return view('livewire.edit-candidate');
    }

    protected $rules = [
        'name' => 'required',
        'image' => 'nullable|image',
    ];

    public function submitForm()
    {
        $this->validate();
        $candidate = $this->candidate;
        $candidate->role_id = $this->role->id;
        $candidate->election_id = $this->election->id;
        $candidate->name = $this->name;
        $candidate->manifesto = $this->manifesto;
        if ($this->image != null) {
            $candidate->image = $this->image->storePublicly('', 'images');
            $this->uploadCount++;
        }
        if ($this->removeImage) {
            $candidate->image = null;
        }
        if ($this->withdraw) {
            $candidate->withdrawn = true;
        }
        if (!$this->withdraw) {
            $candidate->withdrawn = false;
        }
        if ($this->approve && !$candidate->approved) {
            $candidate->approved = true;
            $candidate->order = $this->role->candidates()->where('approved', true)->count()+1;
        }
        $candidate->save();
        return $this->redirect(route('role.edit', ['election' => $this->election->slug, 'role' => $this->role->id]));
    }
}
