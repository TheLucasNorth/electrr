<?php

namespace App\Jobs;

use App\Models\Election;
use App\Models\Voter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class AddEmailVotersInline implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $election;
    private $emails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Election $election, $emails)
    {
        $this->election = $election;
        $this->emails = $emails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->emails as $email) {
            $voter = new Voter();
            $voter->election_id = $this->election->id;
            $voter->username = $voter->safeUsername($this->election->id);
            $password = $voter->password();
            $voter->password_plain = $password;
            $voter->password = Hash::make($password);
            $voter->email = $email;
            $voter->save();
        }
    }
}
