<?php

namespace App\Api\Users\Put;

use App\Business\Users\UsersBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;
use App\Traits\Services\ServicesDataTrait;

class PutUseCases
{
    use ServicesDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: integer,
     *     name: string, 
     *     cpf: string,
     *     birthdate: string,
     *     phone: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $usersBusiness = new UsersBusiness();

        if (!$usersBusiness->isCPFAvailable($payload['cpf'], $payload['id']))
            throw new Exceptions(\lang(\str_replace("{field}", "cpf", lang("Validation.already_exists"))), BAD_AUTH);

        if (!$usersBusiness->isPhoneAvailable($payload['phone'], $payload['id']))
            throw new Exceptions(\lang(\str_replace("{field}", "phone", lang("Validation.already_exists"))), BAD_AUTH);

        $usersModel = new UsersModel();

        /** @var UserEntity */
        $foundUser = $usersModel->where("id", $payload['id'])->first();

        if (empty($foundUser))
            throw new Exceptions(\str_replace("{field}", lang("Words.user"), lang("Validation.not_found")), \BAD_BUSINESS_RULES);

        $foundUser->setEncryptCpf($payload['cpf']);
        $foundUser->setCPFSha1(sha1($payload['cpf']));
        $foundUser->setPhoneSha1(sha1($payload['phone']));
        $foundUser->setEncryptPhone($payload['phone']);
        $foundUser->setName($payload['name']);
        $foundUser->setBirthdate($payload['birthdate']);

        $usersModel->save($foundUser->toArray());

        return (object)[
            "success" => lang("Api.users.success.put")
        ];
    }
}
