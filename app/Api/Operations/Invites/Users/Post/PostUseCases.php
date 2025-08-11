<?php

namespace App\Api\Operations\Invites\Users\Post;

use App\Business\Users\UsersBusiness;
use App\Business\Users\UsersGroupsBusiness;
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
     *   name: string,
     *   email: string,
     *   phone: string,
     *   group: array{number}
     * } $payload
     */
    public function execute(array $payload)
    {
        $session = session();

        $userAuthId = $session->get('userAuthId');
        $usersGroupsBusiness = new UsersGroupsBusiness();
        $usersBusiness = new UsersBusiness();

        if (!$usersBusiness->isEmailAvailable($payload['email']))
            throw new Exceptions("Api.invites.invalid.already_exists_email", BAD_REQUEST);

        if (!$usersBusiness->isPhoneAvailable($payload['phone']))
            throw new Exceptions("Api.invites.invalid.already_exists_phone", BAD_REQUEST);

        if (isset($payload['group']) && !$usersGroupsBusiness->hasGroups($payload['group']))
            throw new Exceptions("Api.invites.invalid.invalid_group", BAD_REQUEST);

        $invitesModel = new InvitesModel();
        $inviteEntity = new InviteEntity();

        $token = new Tokens();
        $tokenInvite = $token->create(4);

        $inviteEntity->setToken($tokenInvite);
        $inviteEntity->setType('USER');
        $inviteEntity->setIsValid(true);
        $inviteEntity->setOwnerId($userAuthId);
        $inviteEntity->setExpiredAt(date('Y-m-d H:i:s', strtotime('+1 day')));

        $crypto = new Crypto();
        $inviteEntity->setData($crypto->encrypt(\json_encode($payload), getenv('system.encrypted_key')));

        $invitesModel->save($inviteEntity);

        $inviteMail = new InviteMail();
        $inviteMail->send([
            "recipients" => [
                [
                    "email" => $payload['email'],
                    "name" => $payload['name']
                ]
            ],
            "inviteToken" => $tokenInvite
        ]);

        NotificationsService::store([
            "scope" => "invites",
            "action" => "CREATE"
        ]);

        return (object)[
            "success" => "Api.invites.success.post"
        ];
    }
}
