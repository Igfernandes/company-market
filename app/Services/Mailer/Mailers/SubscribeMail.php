<?php

namespace App\Services\Mailer\Mailers;

use App\Services\Mailer\MailService;
use App\Services\Mailer\OptionsMail;

class SubscribeMail
{

    /**
     * @param array{
     *  recipients:array{array{
     *  email:string,
     *  name:string
     *  }},
     * } $payload
     */
    public static function send(array $payload): bool
    {
        $mailService = new MailService();
        $optionsMail = new OptionsMail();

        $optionsMail->title = "Bem-vindo à nossa comunidade de inovação digital";
        $optionsMail->recipients = $payload['recipients'];

        foreach ($payload['recipients'] as $recipient) {
            $optionsMail->recipients = [$recipient];

            $optionsMail->html = (string) view('mails/subscribe');

            $mailService->send($optionsMail);
        }

        return true;
    }
}
