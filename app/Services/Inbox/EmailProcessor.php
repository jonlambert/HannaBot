<?php  namespace App\Services\Inbox;

use App\EmailMessage;
use App\Services\Reminders\Scheduler;

class EmailProcessor {

    /**
     * @var Scheduler
     */
    private $scheduler;

    /**
     * @param Scheduler $scheduler
     */
    public function __construct(Scheduler $scheduler)
    {
        $this->scheduler = $scheduler;
    }

    public function run()
    {
        $this->processRemindMe();
    }

    /**
     * TODO: Break this up into different handlers. +remind should parse and schedule reminders, +receipt should store the receipt.
     */
    public function processRemindMe()
    {
        $messages = EmailMessage::where('to', 'LIKE', '%+remind%')->where('actioned', '<>', 1)->get();

        foreach ($messages as $message) {
            $reminder = $this->scheduler->via('email', ['address' => $message->user->email]);
            $time = preg_replace('/Fwd(.*)/', '', $message->subject);

            $reminder = $reminder->at($time)->forUser($message->user->id)->remind($message->message);

            $this->scheduler->schedule($reminder);

            $message->actioned = true;
            print $message->save();
        }
    }
} 
