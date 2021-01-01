<?php

namespace App\Http\Livewire;

use App\Models\Ballot;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RoleDetails extends Component
{

    public Role $role;
    public $voted = false;

    public function mount(Role $role) {
        if (Auth::guard('voter')->check()) {
            $vid = 'v'.Auth::id();
        }
        elseif (Auth::guard('sanctum')->check()) {
            $vid = 'u'.Auth::id();
        }
        if (Ballot::where('role_id', $role->id)->where('voter_id', $vid)->exists()) {
            $this->voted = true;
        }
    }

    public function render()
    {
        return view('livewire.role-details');
    }
}
