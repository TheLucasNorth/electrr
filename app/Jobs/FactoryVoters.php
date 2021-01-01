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

class FactoryVoters implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $count;
    protected $election;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Election $election, $count)
    {
        $this->election = $election;
        $this->count = $count;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        for ($i = 1; $i<=$this->count; $i++) {
            $voter = new Voter();
            $voter->election_id = $this->election->id;
            $voter->username = $voter->safeUsername($this->election->id);
            $password = $voter->password();
            $voter->password_plain = $password;
            $voter->password = Hash::make($password);
            $voter->email = 'no-email';
            $voter->save();
        }
    }
}
