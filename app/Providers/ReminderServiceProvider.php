<?php namespace App\Providers;

use App\Services\Reminders\Scheduler;
use Illuminate\Support\ServiceProvider;

class ReminderServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        /** @var Scheduler $scheduler */
        $scheduler = $this->app->make('App\Services\Reminders\Scheduler');

        $scheduler->addMethod('App\Services\Reminders\EmailMethod');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->singleton(
            'App\Services\Reminders\Repositories\ReminderRepositoryInterface',
            'App\Services\Reminders\Repositories\DatabaseReminderRepository'
        );

        $this->app->singleton('App\Services\Reminders\Scheduler');
	}

}
