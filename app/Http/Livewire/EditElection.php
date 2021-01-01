<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditElection extends Component
{

    public $name;
    public $slug;
    public $description;
    public $imprint;
    public $nominations = false;
    public $shuffle_candidates = false;
    public $message;
    public $shuffle_manifestos = false;
    public $description_home = true;
    public $description_nomination = true;
    public $nomination_contact;
    public $custom;
    public $election;

    protected $rules = [
        'slug' => 'required|alpha_dash|unique:elections',
        'name' => 'required',
        'description' => '',
        'imprint' => '',
        'nominations' => 'boolean|nullable',
        'shuffle_manifestos' => 'boolean|nullable',
        'shuffle_candidates' => 'boolean|nullable',
        'description_home' => 'boolean|nullable',
        'description_nomination' => 'boolean|nullable',
        'nomination_contact' => 'nullable',
        'custom' => 'nullable'
    ];

    public function mount(\App\Models\Election $election) {
        $this->election = $election;
        $this->fill($election);
        $this->nominations = $election->nominations ? true : false;
        $this->shuffle_candidates = $election->shuffle_candidates ? true : false;
    }


    public function render()
    {
        return view('livewire.edit-election');
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName, [
            'slug' => ['required','alpha_dash', Rule::unique('elections')->ignore($this->election)],
            'name' => 'required',
            'description' => '',
            'imprint' => '',
            'nominations' => 'boolean|nullable',
            'shuffle_manifestos' => 'boolean|nullable',
            'shuffle_candidates' => 'boolean|nullable',
            'description_home' => 'boolean|nullable',
            'description_nomination' => 'boolean|nullable',
            'nomination_contact' => 'nullable',
            'custom' => 'nullable'
        ]);
    }

    public function submitForm() {
            // validate using custom unique rule, update model, and save
            $data = $this->validate([
                'slug' => ['required','alpha_dash', Rule::unique('elections')->ignore($this->election)],
                'name' => 'required',
                'description' => '',
                'imprint' => '',
                'nominations' => 'boolean|nullable',
                'shuffle_manifestos' => 'boolean|nullable',
                'shuffle_candidates' => 'boolean|nullable',
                'description_home' => 'boolean|nullable',
                'description_nomination' => 'boolean|nullable',
                'nomination_contact' => 'nullable',
                'custom' => 'nullable'
            ]);
            $election = $this->election;
            $election->name = $this->name;
            $election->description = $this->description;
            $election->imprint = $this->imprint;
            $election->nominations = $this->nominations;
            $election->shuffle_manifestos = $this->shuffle_manifestos;
            $election->shuffle_candidates = $this->shuffle_candidates;
            $election->description_home = $this->description_home;
            $election->description_nomination = $this->description_nomination;
            $election->nomination_contact = $this->nomination_contact;
            $election->custom = $this->custom;
            $election->save();
            $this->message = "Election updated";
    }


}
