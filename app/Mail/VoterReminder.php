<?php

namespace App\Mail;

use App\Models\Election;
use App\Models\Email;
use App\Models\Voter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VoterReminder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var Election
     */
    public Election $election;
    /**
     * @var Voter
     */
    Public Voter $voter;

    /**
     * Create a new message instance.
     *
     * @param Election $election
     * @param Voter $voter
     */
    public function __construct(Election $election, Voter $voter)
    {
        $this->election = $election;
        $this->voter = $voter;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.voter')
            ->text('mail.voter_plain')
            ->subject($this->election->name.': Voting Reminder')
            ->from('no-reply@example.com', $this->election->name)
            ->withSwiftMessage(function ($message) {
                $election = $this->election->slug;
                $message->getHeaders()
                    ->addTextHeader('X-Mailgun-Tag', "ETag: $election");
                $id = $message->getId();
                $email = new Email();
                $email->message_id = $id;
                $email->voter_id = $this->voter->id;
                $email->save();
            });
    }
}
