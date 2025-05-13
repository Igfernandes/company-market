<?php

namespace App\Services\Mailer\Mailers;

use App\Services\Mailer\MailService;
use App\Services\Mailer\OptionsMail;

class ChargeMail
{

    /**
     * @param array{
     *  chargeId: int,
     *  title: string,
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

        $optionsMail->title = $payload['title'] . " - " . \getenv('system.mail.author');
        $optionsMail->recipients = $payload['recipients'];

        $chargeId =  $payload['chargeId'];
        $optionsMail->html = (string) view('mails/charges', ['chargeId' => $chargeId, "title" => $payload['title']]);
        $chargeLink = getenv('globals.href.frontend') . "/charges/$chargeId";
        $optionsMail->textHtml = "Olá, você recebeu um cobrança da plataforma " . \getenv('system.mail.author') . "! Acesse o link: $chargeLink";

        $mailService->send($optionsMail);

        return true;
    }
}
