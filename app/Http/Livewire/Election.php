<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Election extends Component
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


    public function render()
    {

        return view('livewire.election');
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function submitForm() {
            // if creating election for the first time
            $data = $this->validate();
            $data['token'] = Str::random(10);
            $data['user_id'] = Auth::id();
            $election = \App\Models\Election::create($data);
            $this->message = "Election created";
            return $this->redirect('/dashboard/elections/' . $this->slug);
    }


}
