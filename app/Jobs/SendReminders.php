<?php

namespace App\Jobs;

use App\Mail\VoterReminder;
use App\Models\Election;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Election
     */
    public Election $election;

    /**
     * Create a new job instance.
     *
     * @param Election $election
     */
    public function __construct(Election $election)
    {
        $this->election = $election;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->election->voters()->where('email', '!=', 'no-email')->where('unsubscribed', false)->where('voted', false)->get() as $voter) {
            Mail::to($voter->email)->send(new VoterReminder($this->election, $voter));
        }
    }
}
