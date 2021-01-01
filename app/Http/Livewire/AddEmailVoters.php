<?php

namespace App\Http\Livewire;

use App\Jobs\AddEmailVotersInline;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddEmailVoters extends Component
{
    use WithFileUploads;

    public $emails = [];
    public $input;
    public $election;
    public $message;
    public $file;
    public $uploadCount = 0;

    public function mount(\App\Models\Election $election) {
        $this->election = $election;
    }

    public function render()
    {
        return view('livewire.add-email-voters');
    }

    public function updatedInput($value) {
        $emails = explode(';', $value);
        $this->emails = array_filter(filter_var_array($emails, FILTER_VALIDATE_EMAIL));
    }

    public function createInput() {
        AddEmailVotersInline::dispatch($this->election, $this->emails);
        $this->input = '';
        $this->emails = [];
        $this->message = 'Voters created, please wait while they are added';
        $this->emit('voterAdded')->up();
    }

    public function createFile() {
        $this->validateOnly('file', [
            'file' => 'required'
        ]);

        $name = Str::random(40).'.csv';
        $this->file->storeAs('uploads', $name);
        $this->file = null;
        $this->uploadCount++;
        \App\Jobs\AddEmailVoters::dispatch($this->election, $name);
        $this->message = 'Voters created, please wait while they are added';
        $this->emit('voterAdded')->up();
    }

}
