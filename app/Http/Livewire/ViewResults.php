<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ResultController;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ViewResults extends Component
{
    protected $role;
    protected $election;
    public $results;

    public function mount(\App\Models\Election $election, Role $role, $method) {
        $this->election = $election;
        $this->role = $role;

        // this will use the defined method in ResultController. This can be changed as needed, swapped based on how electrr is being used, etc - calling the method here means that web and API returns are the same
        $results = app(ResultController::class)->calculate($election, $role, $method);

        $this->results = $results;
    }

    public function render()
    {
        return view('livewire.view-results');
    }
}
