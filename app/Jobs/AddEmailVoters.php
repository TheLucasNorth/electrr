<?php

namespace App\Jobs;

use App\Imports\VotersImport;
use App\Models\Election;
use App\Models\Voter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AddEmailVoters implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Election
     */
    private Election $election;
    private $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Election $election, $file)
    {
        $this->election = $election;
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $import = Excel::toArray(new VotersImport(), 'uploads/'.$this->file, 'local');
        $emails = $import[0];
        foreach ($emails as $key => $email) {
            $voter = new Voter();
            $voter->election_id = $this->election->id;
            $voter->username = $voter->safeUsername($this->election->id);
            $password = $voter->password();
            $voter->password_plain = $password;
            $voter->password = Hash::make($password);
            $voter->email = $email[0];
            $voter->save();
        }
        $emails = null;
        Storage::delete('uploads/'.$this->file);
    }
}
