<?php

namespace App\Services\Mailer\Mailers;

use App\Services\Mailer\MailService;
use App\Services\Mailer\OptionsMail;

class WelcomeMail
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
        $view = view(
            'mails/welcome',
            [
                'name' => $payload['name'],
                'createdAt' => $payload['createdAt'],
                'country' => $payload['country'],
                'platform' => $payload['platform'],
                'browser' => $payload['browser'],
                'ipAddress' => $payload['ipAddress'],
            ]
        );

        $optionsMail->title = "Mensagens de Boas Vindas - " . \getenv('system.mail.author');
        $optionsMail->recipients = [$payload['recipient']];

        $optionsMail->html = $view;
        $inviteLink = getenv('globals.href.frontend') . "/create-user?invite_token=" . $payload['invite_token'];
        $optionsMail->textHtml = "Olá, você foi convidado a fazer parte da plataforma da AGM! Acesse o link: $inviteLink";

        $mailService->send($optionsMail);

        return true;
    }
}
