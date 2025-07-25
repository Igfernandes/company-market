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

        $optionsMail->title =  lang("Mails.invites.subject") . \getenv('system.mail.author');
        $optionsMail->recipients = $payload['recipients'];

        $optionsMail->html = (string) view('mails/invite', ['inviteToken' => $payload['inviteToken']]);
        $inviteLink = getenv('globals.href.frontend') . "/create-user?invite_token=" . $payload['inviteToken'];
        $optionsMail->textHtml =  str_replace(["{company}", "{link}"], [\getenv('system.mail.author'), $inviteLink],  lang("Mails.unsubscribe.text_aux"));;

        $mailService->send($optionsMail);

        return true;
    }
}
