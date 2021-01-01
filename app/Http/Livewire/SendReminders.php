<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SendReminders extends Component
{
    public \App\Models\Election $election;
    public $sent;

    public function render()
    {
        return view('livewire.send-reminders');
    }

    public function sendEmails() {
        $this->sent = true;
        \App\Jobs\SendReminders::dispatch($this->election);
    }
}
