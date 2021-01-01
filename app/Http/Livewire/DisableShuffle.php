<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DisableShuffle extends Component
{

    public $disabled;

    public function mount() {
        if (session()->get('disableShuffle')) {
            $this->disabled = true;
        }
    }

    public function render()
    {
        return view('livewire.disable-shuffle');
    }

    public function disableShuffle() {
        session()->put('disableShuffle', true);
        $this->disabled = true;
    }
}
