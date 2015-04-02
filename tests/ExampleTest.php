<?php

use Illuminate\Console\Scheduling\Event;

class ExampleTest extends TestCase {

    /**
     * A basic functional test example.
     *
     * @return void
     */
	public function testBasicExample()
	{
		$response = $this->call('GET', '/');



		$this->assertEquals(200, $response->getStatusCode());
	}

    public function testAddReminderToSchedule()
    {
        $ledger = App::make('App\Services\Reminders\Scheduler');

        $reminder = $ledger->via('email', ['address' => 'jonlambert@icloud.com'])
               ->remind('Meeting with Sarah')
               ->forUser(1)
               ->at('1pm');


        $processor = App::make('App\Services\Inbox\EmailProcessor');
        $processor->run();
    }
}
