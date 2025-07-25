<?php

namespace App\Services\Mailer\Mailers;

use App\Database\Entities\Services\ServiceEntity;
use App\Services\Mailer\MailService;
use App\Services\Mailer\OptionsMail;

class UnsubscribeMail
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

        $optionsMail->title = lang("Mails.unsubscribe.subject") . " - " . \getenv('system.mail.author');

        foreach ($payload['recipients'] as $recipient) {
            $optionsMail->recipients = [$recipient];

            $optionsMail->html = (string) view('mails/unsubscribe', [
                'service' => $service,
                'client' => $recipient['name']
            ]);
            $optionsMail->textHtml = \str_replace("{serviceName}", $service->getName(),  lang("Mails.unsubscribe.text_aux"));

            $mailService->send($optionsMail);
        }

        return true;
    }
}
