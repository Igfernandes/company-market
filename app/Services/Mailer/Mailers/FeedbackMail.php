<?php

namespace App\Services\Mailer\Mailers;

use App\Services\Mailer\MailService;
use App\Services\Mailer\OptionsMail;

class FeedbackMail
{

    /**
     * @param array{
     *  recipients:array{array{
     *  email:string,
     *  name:string
     *  }},
     *  data: array
     * } $payload
     */
    public static function send(array $payload): bool
    {
        $mailService = new MailService();
        $optionsMail = new OptionsMail();

        $optionsMail->title = "Nova E-mail Enviado Para Company";
        $optionsMail->recipients = $payload['recipients'];

        foreach ($payload['recipients'] as $recipient) {
            $optionsMail->recipients = [$recipient];

            $optionsMail->html = (string) view('mails/feedback', $payload['data']);

            $mailService->send($optionsMail);
        }

        return true;
    }
}
