<?php

namespace App\Api\Operations\Invites\Users\Resend;

use App\Database\Entities\Invites\InviteEntity;
use App\Database\Models\Invites\InvitesModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;
use App\Libraries\Tokens\Tokens;
use App\Services\Mailer\Mailers\InviteMail;
use App\Services\Notifications\NotificationsService;

class PostUseCases
{
    /**
     * @param array{
     *   id: integer
     * } $payload
     */
    public function execute(array $payload)
    {
        $invitesModel = new InvitesModel();

        $inviteId = $payload['id'];
        /** @var InviteEntity */
        $foundInvite = $invitesModel->where("id = $inviteId")->first();

        if (empty($foundInvite))
            throw new Exceptions("Api.invites.invalid.not_found", \BAD_BUSINESS_RULES);

        $crypto = new Crypto();
        $token = new Tokens();
        $tokenInvite = $token->create(4);

        $inviteEntity = $foundInvite;
        $inviteDataDecrypted = $crypto->decrypt($inviteEntity->getData(), getenv('system.encrypted_key'));
        $inviteData = \json_decode($inviteDataDecrypted);
        $inviteEntity->setToken($tokenInvite);
        $inviteEntity->setIsValid(true);
        $inviteEntity->setExpiredAt(date('Y-m-d H:i:s', strtotime('+1 day')));

        $invitesModel->set($inviteEntity->toArray())->where("id = $inviteId")->update();

        $inviteMail = new InviteMail();
        $inviteMail->send([
            "recipients" => [
                [
                    "email" => $inviteData->email,
                    "name" => $inviteData->name
                ]
            ],
            "inviteToken" => $tokenInvite
        ]);

        NotificationsService::store([
            "scope" => "invites",
            "action" => "UPDATE"
        ]);
        return (object)[
            "success" => "Api.invites.success.resend"
        ];
    }
}
