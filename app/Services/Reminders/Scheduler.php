<?php  namespace App\Services\Reminders;

use App\Services\Reminders\Repositories\ReminderRepositoryInterface;
use Illuminate\Contracts\Container\Container;

class Scheduler {

    public $methods = [];

    /**
     * @var ReminderRepositoryInterface $repository
     */
    private $repository;
    /**
     * @var Container
     */
    private $app;

    /**
     * @param ReminderRepositoryInterface $repository
     * @param Container $app
     */
    public function __construct(ReminderRepositoryInterface $repository, Container $app)
    {
        $this->repository = $repository;
        $this->app = $app;
    }

    public function addMethod($methodClass)
    {
        $method = $this->app->make($methodClass);
        $this->methods[$method->name] = $method;
    }

    /**
     * @param $name
     * @return Method
     */
    public function getMethod($name)
    {
        return $this->methods[$name];
    }

    /**
     * Factory method returning a new Reminder instance.
     *
     * @param $method
     * @param $options
     * @return Reminder
     */
    public function via($method, $options)
    {
        $reminder = new Reminder();
        $reminder->via($method, $options);

        return $reminder;
    }

    /**
     * Add Reminder to the registry.
     * @param Reminder $reminder
     */
    public function schedule(Reminder $reminder)
    {
        $this->repository->save($reminder);
    }

    /**
     * Use the defined method to execute the reminder.
     *
     * @param Reminder $reminder
     */
    public function perform(Reminder $reminder)
    {
        $method = $this->getMethod($reminder->methodName);
        $method->run($reminder);
    }

    /**
     * Process the relevant reminders.
     */
    public function process()
    {
        $reminders = $this->repository->relevant();

        foreach ($reminders as $reminder)
        {
            $this->perform($reminder);
            $this->repository->delete($reminder);
        }
    }

} 