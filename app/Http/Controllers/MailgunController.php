<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Voter;
use Illuminate\Http\Request;

class MailgunController extends Controller
{
    public function delivered(Request $request)
    {
        $message = $request->input('event-data.message.headers.message-id');
        if (Email::where('message_id', $message)->exists()) {
            $email = Email::where('message_id', '=', $message)->first();
            $email->delivered = true;
            $email->save();
            $voter = Voter::whereId($email->voter_id)->first();
            $voter->delivered = true;
            $voter->save();
        }
        return 'thank you mailgun';
    }

    public function bounced(Request $request)
    {
        $message = $request->input('event-data.message.headers.message-id');
        if (Email::where('message_id', $message)->exists()) {
            $email = Email::where('message_id', $message)->first();
            $email->bounced = true;
            $email->save();
            $voter = Voter::whereId($email->voter_id)->first();
            $voter->bounced = true;
            $voter->save();
        }
        return 'thank you mailgun';
    }

    public function unsubscribed(Request $request)
    {
        $message = $request->input('event-data.message.headers.message-id');
        if (Email::where('message_id', $message)->exists()) {
            $email = Email::where('message_id', $message)->first();
            $email->unsubscribed = true;
            $email->save();
            $voter = Voter::whereId($email->voter_id)->first();
            $voter->unsubscribed = true;
            $voter->save();
        }
        return 'thank you mailgun';
    }

    public function opened(Request $request)
    {
        $message = $request->input('event-data.message.headers.message-id');
        if (Email::where('message_id', $message)->exists()) {
            $email = Email::where('message_id', $message)->first();
            $email->opened = true;
            $email->save();
            $voter = Voter::whereId($email->voter_id)->first();
            $voter->opened = true;
            $voter->save();
        }
        return 'thank you mailgun';
    }

    public function complained(Request $request)
    {
        $message = $request->input('event-data.message.headers.message-id');
        if (Email::where('message_id', $message)->exists()) {
            $email = Email::where('message_id', $message)->first();
            $email->complained = true;
            $email->save();
            $voter = Voter::whereId($email->voter_id)->first();
            $voter->complained = true;
            $voter->unsubscribed = true;
            $voter->save();
        }
        return 'thank you mailgun';
    }
}
