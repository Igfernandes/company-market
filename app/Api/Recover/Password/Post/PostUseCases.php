<?php

namespace App\Api\Recover\Password\Post;

use App\Database\Entities\Users\UserTokenEntity;
use App\Database\Models\Users\UsersModel;
use App\Database\Models\Users\UsersTokensModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;
use App\Libraries\Tokens\Tokens;
use App\Services\Mailer\Mailers\RequestPasswordMail;

class PostUseCases
{
    /**
     * @param array{
     *   email: string
     */
    public function execute(array $payload)
    {
        $usersModel = new UsersModel();

        $foundUser =  $usersModel->where("email_sha1", sha1($payload['email']))->first();

        if (empty($foundUser))
            throw new Exceptions(\lang(\str_replace("{field}", "email", lang("Validation.already_exists"))), BAD_REQUEST);

        $crypto = new Crypto();
        $encryptedEmail = $crypto->encrypt($payload['email'], getenv('system.encrypted_key'));
        $data = \json_encode((object)[
            "email" => $encryptedEmail
        ]);

        $usersTokensModel = new UsersTokensModel();
        /** @var UserTokenEntity */
        $foundUsersTokens = $usersTokensModel->where([
            "is_valid" => true,
            "JSON_UNQUOTE(JSON_EXTRACT(data, '$.email')) =" => $encryptedEmail,
            'expired_at >' => date('Y-m-d H:i:s', strtotime('+0 day'))
        ])->first();

        $invitesModel = new UsersTokensModel();
        $userTokenEntity = new UserTokenEntity();

        if (!empty($foundUsersTokens)) {
            $userTokenEntity->setId($foundUsersTokens->getId());
        }

        $token = new Tokens();
        $recoverToken = $token->create(4);

        $userTokenEntity->setToken($recoverToken);
        $userTokenEntity->setOperation("REQUEST");
        $userTokenEntity->setPath('users/password');
        $userTokenEntity->setIsValid(true);
        $userTokenEntity->setUserId($foundUser->getId());
        $userTokenEntity->setAccessibility("PUBLIC");
        $userTokenEntity->setExpiredAt(date('Y-m-d H:i:s', strtotime('+1 day')));

        $userTokenEntity->setData($data);

        $invitesModel->save($userTokenEntity);

        $recoverPasswordMail = new RequestPasswordMail();
        $recoverPasswordMail->send([
            "recipients" => [
                [
                    "email" => $payload['email'],
                    "name" => $foundUser->getName()
                ]
            ],
            "recoverToken" => $recoverToken
        ]);

        return (object)[
            "success" => lang("Api.users.success.recover_password")
        ];
    }
}
