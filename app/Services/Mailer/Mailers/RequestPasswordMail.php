<?php

namespace App\Services\Mailer\Mailers;

use App\Services\Mailer\MailService;
use App\Services\Mailer\OptionsMail;

class RequestPasswordMail
{

    /**
     * @param array{
     *  recipients:array{array{
     *  email:string,
     *  name:string
     *  }},
     *  recoverToken:string
     * } $payload
     */
    public function send(array $payload): bool
    {
        $mailService = new MailService();

        $optionsMail = new OptionsMail();

        $optionsMail->title = "Alteração de senha - " . \getenv('system.mail.author');
        $optionsMail->recipients = $payload['recipients'];

        $optionsMail->html = (string) view('mails/recover_password', [
            'name' => $payload['recipients'][0]['name'],
            'recoverToken' => $payload['recoverToken']
        ]);
        $recoverLink = getenv('globals.href.frontend') . "/?alter-password=" . $payload['recoverToken'];
        $optionsMail->textHtml = "Olá, você recebeu uma solicitação para alteração de senha da plataforma " . \getenv('system.mail.author') . "! Acesse o link: $recoverLink";

        $mailService->send($optionsMail);

        return true;
    }
}
