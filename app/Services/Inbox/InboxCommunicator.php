<?php  namespace App\Services\Inbox;

use App\EmailMessage;
use App\TriggerAddress;
use Carbon\Carbon;
use DateTime;
use Fetch\Message;
use Fetch\Server;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psy\Exception\ErrorException;

class InboxCommunicator {

    /**
     * @var Server
     */
    private $server;
    /**
     * @var Repository
     */
    private $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
        $this->server = new Server(
            $config->get('inbox.host'),
            $config->get('inbox.port'),
            $config->get('inbox.service', 'imap')
        );
        $this->server->setAuthentication(
            $config->get('inbox.username'),
            $config->get('inbox.password')
        );
    }

    public function fetchAll()
    {
        // Get all messages
        $messages = $this->server->search('UNSEEN');

        print count($messages) . ' found.' . PHP_EOL;

        /** @var Message $emailMessage */
        foreach ($messages as $emailMessage) {
            $user = TriggerAddress::getUser($emailMessage->getAddresses('from')['address']);

            if (! $user) {
                $emailMessage->setFlag(Message::FLAG_SEEN, false);
                print 'User not found. Marking as Unseen.';
                continue;
            }

            if (! EmailMessage::isUnique($emailMessage->getUid())) {
                print 'Email already exists in system.';
                continue;
            }


            // Setup Carbon object for the sent date
            $date = new Carbon();
            $date->setTimestamp($emailMessage->getDate());

            // Persist the email locally
            $message = new EmailMessage([
                'uid'          => $emailMessage->getUid(),
                'subject'       => $emailMessage->getSubject(),
                'user_id'       => $user->id,
                'message'       => $emailMessage->getMessageBody(false),
                'html_message'  => $emailMessage->getMessageBody(true),
                'sent'          => $date,
                'from'          => $emailMessage->getAddresses('from')['address'],
                'to'            => $emailMessage->getAddresses('to')[0]['address']
            ]);
            $message->save();
        }
    }

    public function getServer()
    {

    }
}