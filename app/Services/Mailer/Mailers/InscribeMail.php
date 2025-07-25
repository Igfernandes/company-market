<?php

namespace App\Services\Mailer\Mailers;

use App\Database\Entities\Services\ServiceEntity;
use App\Services\Mailer\MailService;
use App\Services\Mailer\OptionsMail;

class InscribeMail
{

    /**
     * @param array{
     *  recipients:array{array{
     *  email:string,
     *  name:string
     *  }},
     *  service:ServiceEntity
     * } $payload
     */
    public static function send(array $payload): bool
    {
        $mailService = new MailService();
        $optionsMail = new OptionsMail();

        /** @var ServiceEntity */
        $service = $payload['service'];

        $optionsMail->title = lang("Mails.inscribe.subject") . \getenv('system.mail.author');
        $optionsMail->recipients = $payload['recipients'];

        foreach ($payload['recipients'] as $recipient) {
            $optionsMail->recipients = [$recipient];

            $optionsMail->html = (string) view('mails/inscribe', [
                'service' => $service,
                'client' => $recipient['name'],
                'clientId' => $recipient['client_id']
            ]);
            $link =  getenv('globals.href.frontend') . "/services/confirmation?key={$service->getId()}&client=" . $recipient['client_id'];

            $optionsMail->textHtml =  \str_replace(["{serviceName}", "{link}"], [$service->getName(), $link],  lang("Mails.inscribe.text_aux"));

            $mailService->send($optionsMail);
        }

        return true;
    }
}
