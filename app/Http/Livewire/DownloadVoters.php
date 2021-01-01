<?php

namespace App\Http\Livewire;

use App\Exports\VotersExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class DownloadVoters extends Component
{
    public \App\Models\Election $election;

    public function render()
    {
        return view('livewire.download-voters');
    }

    public function downloadVoters() {
        return Excel::download(new VotersExport($this->election), $this->election->name.' voters.xlsx');
    }
}
