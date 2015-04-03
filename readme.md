## HannaBot
HannaBot lets you organise yourself, using email. Register a free email account with Gmail (or other provider), then link it to HannaBot. 

## Reminders
When you send an email to `<your-username>+remind@gmail.com`, with a date in the subject field, HannaBot will send the email back to you on that specified date. 

```
To: <your-username>+remind@gmail.com
From: <your trigger email>
Subject: 2 days
Body: 
-- Forwarded email --

Hi Jon,

This is an email I've sent to you, that I need you to reply to in 2 days.

Thanks,
Dave
```

## Install requirements
Required PHP Modules:
* php5-imap
* php5-ssl
* php-mcrypt
    
    
## Installation
```bash
git clone https://github.com/jonlambert/HannaBot.git HannaBot && cd HannaBot
composer install
```
Once dependancies are installed, add your email/database credentials to the `.env` file. 
```bash
cp .env.example .env
vim .env
```
HannaBot relies on Laravel's Console Scheduler. This means you don't need to setup loads of cronjobs, just one!
```
* * * * * php /path/to/hannabot/installation/artisan schedule:run 1>> /dev/null 2>&1
```
Visit `<host>/auth/login` to register/login. You can then add *trigger email addresses* on the home page. These are a whitelist list of email addresses that will allow you to send email from.
