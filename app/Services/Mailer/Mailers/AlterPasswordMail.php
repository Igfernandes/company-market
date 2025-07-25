<?php

namespace App\Services\Mailer\Mailers;

use App\Services\Mailer\MailService;
use App\Services\Mailer\OptionsMail;

class AlterPasswordMail
{

    /**
     * @param array{
     *  name: string
     *  recipient:string,
     *  createdAt:string,
     *  country:string,
     *  platform:string,
     *  browser:string,
     *  ipAddress:string
     * } $payload
     */
    public function send(array $payload): bool
    {
        $mailService = new MailService();
        $optionsMail = new OptionsMail();

        $optionsMail->title = lang("Mails.alter_password.subject") . " - " . \getenv('system.mail.author');
        $optionsMail->recipients = $payload['recipients'];

        $optionsMail->html = (string) view('mails/alter_password', [
            'name' => $payload['name'],
            'createdAt' => $payload['createdAt'],
            'country' => $payload['country'],
            'platform' => $payload['platform'],
            'browser' => $payload['browser'],
            'ipAddress' => $payload['ipAddress'],
        ]);

        $optionsMail->textHtml = lang("Mails.alter_password.text_aux");

        $mailService->send($optionsMail);

        return true;
    }
}
