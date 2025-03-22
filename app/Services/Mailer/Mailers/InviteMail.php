<?php

namespace App\Services\Mailer\Mailers;

use App\Services\Mailer\MailService;
use App\Services\Mailer\OptionsMail;

class InviteMail
{

    /**
     * @param array{
     *  recipients:array{array{
     *  email:string,
     *  name:string
     *  }},
     *  inviteToken:string
     * } $payload
     */
    public function send(array $payload): bool
    {
        $mailService = new MailService();

        $optionsMail = new OptionsMail();

        $optionsMail->title = "Convite para cadastro - " . \getenv('system.mail.author');
        $optionsMail->recipients = $payload['recipients'];

        $optionsMail->html = (string) view('mails/invite', ['inviteToken' => $payload['inviteToken']]);
        $inviteLink = getenv('globals.href.frontend') . "/create-user?invite_token=" . $payload['inviteToken'];
        $optionsMail->textHtml = "Olá, você foi convidado a fazer parte da plataforma da AGM! Acesse o link: $inviteLink";

        $mailService->send($optionsMail);

        return true;
    }
}
