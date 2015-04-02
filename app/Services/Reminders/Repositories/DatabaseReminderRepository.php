<?php  namespace App\Services\Reminders\Repositories;
use App\Services\Reminders\Reminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DatabaseReminderRepository implements ReminderRepositoryInterface {

    /**
     * Persist a reminder.
     *
     * @param Reminder $reminder
     * @return mixed
     */
    public function save(Reminder $reminder)
    {
        return DB::table('reminders')->insert([
            'user_id' => $reminder->userId,
            'method' => $reminder->methodName,
            'time' => $reminder->time,
            'options' => json_encode($reminder->options),
            'body' => $reminder->body
        ]);
    }

    /**
     * Return all reminders relevant to the current point in time.
     * Basically, any returned have passed their due time and should be performed.
     *
     * @param null $time
     * @return mixed
     */
    public function relevant($time = null)
    {
        if ($time == null)
            $time = Carbon::now();

        $reminders = [];
        $reminderRecords = DB::table('reminders')->where('time', '<', $time)->get();

        foreach ($reminderRecords as $reminderRecord) {
            $reminder = new Reminder();
            $reminder->time = $reminderRecord->time;
            $reminder->body = $reminderRecord->body;
            $reminder->options = json_decode($reminderRecord->options);
            $reminder->methodName = $reminderRecord->method;
            $reminder->userId = $reminderRecord->user_id;
            $reminder->id = $reminderRecord->id;

            $reminders[] = $reminder;
        }

        return $reminders;
    }

    /**
     * Delete the supplied reminder.
     *
     * @param Reminder $reminder
     * @return mixed
     */
    public function delete(Reminder $reminder)
    {
        DB::table('reminders')->where('id', '=', $reminder->id)->delete();
    }
}