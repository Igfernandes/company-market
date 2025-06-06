<?php

namespace App\Services\Mailer\Mailers;

use App\Services\Mailer\MailService;
use App\Services\Mailer\OptionsMail;

class MessageMail
{

    /**
     * @param array{
     *  content: int,
     *  recipients:array{array{
     *  email:string,
     *  name:string
     *  }},
     * } $payload
     */
    public function send(array $payload): bool
    {
        $mailService = new MailService();
        $optionsMail = new OptionsMail();

        $optionsMail->title = "Notificação - " . \getenv('system.mail.author');
        $optionsMail->recipients = $payload['recipients'];

        $optionsMail->html = (string) view('mails/messages', [
            "content" => $payload['content']
        ]);

        $optionsMail->textHtml = "Olá, você recebeu uma nova notificação da plataforma " . \getenv('system.mail.author');

        $mailService->send($optionsMail);

        return true;
    }
}
