<?php  namespace App\Console\Commands;
use App\Services\Inbox\InboxCommunicator;
use Illuminate\Console\Command;


class Read extends Command {

    protected $name = 'read';

    protected $description = 'Read and process all emails in the inbox.';
    protected $inbox;

    public function __construct(InboxCommunicator $inbox)
    {
        $this->inbox = $inbox;

        parent::__construct();
    }

    public function handle()
    {
        $this->inbox->fetchAll();
    }

} 