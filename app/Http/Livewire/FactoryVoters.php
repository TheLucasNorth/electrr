<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class FactoryVoters extends Component
{
    public $number;
    public \App\Models\Election $election;
    public $message;

    public function render()
    {
        return view('livewire.factory-voters');
    }

    protected $rules = [
      'number' => 'required|integer'
    ];

    public function updated($property) {
        $this->validateOnly($property);
    }

    public function submitForm() {
        $this->validate();
        \App\Jobs\FactoryVoters::dispatch($this->election, $this->number);
        $this->message = "Voters queued for creation. Please be patient while they are added.";
    }
}
