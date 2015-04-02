<?php  namespace App\Services\Reminders;

abstract class Method {
    public $name = 'default';

    public function run(Reminder $reminder)
    {
        // Run the method.
    }
} 