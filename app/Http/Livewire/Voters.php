<?php

namespace App\Http\Livewire;

use App\Models\Voter;
use Livewire\Component;
use Livewire\WithPagination;

class Voters extends Component
{
    use WithPagination;

    public $election;
    public $search = '';
    public $remove = [];
    public $selected = [];

    public function mount(\App\Models\Election $election) {
        $this->election = $election;
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function updated($property, $value) {
        $explode = explode('.',$property);
        if($explode[0] === "selected") {
            if($value) {
                $this->remove[] = $explode[1];
            }
            else {
                $key = array_search($explode[1], $this->remove);
                unset($this->remove[$key]);
            }
        }
    }

    public function removeSelected() {
        foreach ($this->remove as $item) {
            Voter::destroy($item);
        }
        $this->remove = [];
        $this->selected = [];
        $this->message = "Voters removed";
    }

    public function render()
    {
        return view('livewire.voters', [
            'voters' => Voter::where(function ($query) {
                $query->where('email', 'like', '%' . $this->search . '%')
                ->orWhere('username', 'like', '%' . $this->search . '%');
            })->where('election_id', $this->election->id)
                ->paginate(25),
        ]);
    }
}
