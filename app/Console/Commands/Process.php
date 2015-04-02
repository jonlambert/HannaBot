<?php namespace App\Console\Commands;

use App\Services\Reminders\Scheduler;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Process extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'reminders:process';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Process reminders.';
    /**
     * @var Scheduler
     */
    private $scheduler;

    /**
     * Create a new command instance.
     *
     * @param Scheduler $scheduler
     * @return \App\Console\Commands\Process
     */
	public function __construct(Scheduler $scheduler)
	{
        $this->scheduler = $scheduler;
        parent::__construct();
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $this->scheduler->process();
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
