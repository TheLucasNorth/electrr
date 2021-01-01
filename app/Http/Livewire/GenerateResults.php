<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;

class GenerateResults extends Component
{

    public Role $role;
    public $election;
    public $method = 'Approval';
    public $ranked;

    public function mount(\App\Models\Election $election) {
        $this->ranked = $this->role->ranked;
        $this->election  = $election->slug;
    }

    public function render()
    {
        return view('livewire.generate-results');
    }

    public function submitForm() {
        return $this->redirect(route('results.calculate', ['election' => $this->election, 'role' => $this->role->id, 'method' => $this->method]));
    }
}
