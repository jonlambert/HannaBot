<?php namespace App\Console\Commands;

use App\Services\Inbox\EmailProcessor;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ProcessEmails extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'emails:process';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = '';
    /**
     * @var EmailProcessor
     */
    private $emailProcessor;

    /**
     * Create a new command instance.
     *
     * @param EmailProcessor $emailProcessor
     * @return \App\Console\Commands\ProcessEmails
     */
	public function __construct(EmailProcessor $emailProcessor)
	{
        $this->emailProcessor = $emailProcessor;
        parent::__construct();
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->emailProcessor->run();
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
