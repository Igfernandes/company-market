<?php

namespace App\Services\Mailer\Mailers;

use App\Services\Mailer\MailService;
use App\Services\Mailer\OptionsMail;

class ContactMail
{

    /**
     * @param array{
     *  recipients:array{array{
     *  email:string,
     *  name:string
     *  }}
     * } $payload
     */
    public static function send(array $payload): bool
    {
        $mailService = new MailService();
        $optionsMail = new OptionsMail();

        $optionsMail->title = "Mensagem recebida pela equipe Company Market";
        $optionsMail->recipients = $payload['recipients'];

        foreach ($payload['recipients'] as $recipient) {
            $optionsMail->recipients = [$recipient];

            $optionsMail->html = (string) view('mails/contact');

            $mailService->send($optionsMail);
        }

        return true;
    }
}
