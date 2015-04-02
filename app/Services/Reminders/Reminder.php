<?php  namespace App\Services\Reminders;

use App\User;
use Carbon\Carbon;

class Reminder {

    /**
     * When should this reminder be executed?
     *
     * @var Carbon $time
     */
    public $time;

    /**
     * The reminder's owner.
     *
     * @var int $userId
     */
    public $userId;


    /**
     * The options for the reminder.
     *
     * @var int $reminder
     */
    public $options;

    /**
     * The reminder format. Modified by child classes.
     *
     * eg. 'email'
     *
     * @var string
     */
    public $methodName = 'default';

    /**
     * The actual body of the reminder.
     *
     * @var string
     */
    public $body;

    /**
     * ID for use by repositories.
     * @var int
     */
    public $id;


    /**
     * Set the time of the reminder.
     *
     * @param $time
     * @return $this
     */
    public function at($time)
    {
        if (! $time instanceof Carbon)
            $time = new Carbon($time);

        $this->time = $time;
        return $this;
    }

    /**
     * Which user does this reminder belong to?
     * This is an ID rather than an instance to keep it reusable.
     *
     * @param $userId
     * @internal param int $user
     * @return $this
     */
    public function forUser($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * The method with which the reminder will be processed.
     *
     * @param $methodName
     * @param $options
     */
    public function via($methodName, $options)
    {
        $this->options = $options;
        $this->methodName = $methodName;
    }

    /**
     * The body of the reminder.
     *
     * @param $body
     * @return Reminder $this
     */
    public function remind($body)
    {
        $this->body = $body;
        return $this;
    }

} 