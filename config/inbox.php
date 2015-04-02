<?php

return [
    'host' => 'imap.gmail.com',
    'port' => 993,
    'ssl' => true,

    'username' => env('IMAP_MAIL_USERNAME'),
    'password' => env('IMAP_MAIL_PASSWORD')
];