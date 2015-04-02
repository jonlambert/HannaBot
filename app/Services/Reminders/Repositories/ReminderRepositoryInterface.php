<?php  namespace App\Services\Reminders\Repositories;

use App\Services\Reminders\Reminder;

interface ReminderRepositoryInterface {

    /**
     * Persist a reminder.
     *
     * @param Reminder $reminder
     * @return mixed
     */
    public function save(Reminder $reminder);

    /**
     * Return all reminders relevant to the current point in time.
     * Basically, any returned have passed their due time and should be performed.
     *
     * @param null $time
     * @return array<Reminder>
     */
    public function relevant($time = null);

    /**
     * Delete the supplied reminder.
     *
     * @param Reminder $reminder
     * @return mixed
     */
    public function delete(Reminder $reminder);
} 