<?php  namespace App\Services\Reminders;

use Illuminate\Contracts\Mail\Mailer;

class EmailMethod extends Method {

    public $name = 'email';

    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function run(Reminder $reminder)
    {
        $this->mailer->raw($reminder->body, function($message) use ($reminder) {
            $message->to($reminder->options->address);
            $message->subject('Reminder about this email!');
        });
    }
} 