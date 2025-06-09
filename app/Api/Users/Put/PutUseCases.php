<?php

namespace App\Api\Users\Put;

use App\Business\Users\UsersBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;
use App\Traits\BusinessTrait;
use App\Traits\Services\ServicesDataTrait;

class PutUseCases
{
    use ServicesDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: integer,
     *     name: string, 
     *     email: string,
     *     phone: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $usersBusiness = new UsersBusiness();

        if (!$usersBusiness->isPhoneAvailable($payload['phone'], $payload['id']))
            throw new Exceptions(\lang(\str_replace("{field}", "phone", lang("Validation.already_exists"))), BAD_AUTH);

        $usersModel = new UsersModel();

        /** @var UserEntity */
        $foundUser = $usersModel->where("id", $payload['id'])->first();

        if (empty($foundUser))
            throw new Exceptions(\str_replace("{field}", lang("Words.user"), lang("Validation.not_found")), \BAD_BUSINESS_RULES);


        $foundUser->setEmailSha256(\referenceHash($payload['email']));
        $foundUser->setEncryptEmail($payload['email']);
        $foundUser->setPhoneSha256(\referenceHash($payload['phone']));
        $foundUser->setEncryptPhone($payload['phone']);
        $foundUser->setName($payload['name']);

        if (!empty($foundUser->toArray(true)))
            $usersModel->set($foundUser->toArray(true))->where("id", $foundUser->getId())->update();


        NotificationsService::store([
            "scope" => "users",
            "action" => "UPDATE"
        ]);
        return (object)[
            "success" => lang("Api.users.success.put")
        ];
    }
}
