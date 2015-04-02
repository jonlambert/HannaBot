<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
        'App\Console\Commands\Read',
        'App\Console\Commands\Process',
        'App\Console\Commands\ProcessEmails',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('inspire')
				 ->hourly();

        $schedule->command('read')->cron('*/2 * * * * *');
        $schedule->command('reminders:process')->cron('*/1 * * * * *');
        $schedule->command('emails:process')->cron('*/1 * * * * *');
	}

}
