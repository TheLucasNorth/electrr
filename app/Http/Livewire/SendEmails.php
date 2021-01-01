<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SendEmails extends Component
{
    public \App\Models\Election $election;
    public $sent;

    public function render()
    {
        return view('livewire.send-emails');
    }

    public function sendEmails() {
        $this->sent = true;
        \App\Jobs\SendEmails::dispatch($this->election);
    }

}
