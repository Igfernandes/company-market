<?php

namespace App\Api\Clients\Put;

use App\Business\Clients\CategoryBusiness;
use App\Database\Entities\clients\ClientCategoryEntity;
use App\Database\Entities\Clients\ClientEntity;
use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Database\Models\Clients\ClientsModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;

class PutUseCases
{
    /**
     * @param array{
     *   id: integer,
     *   name: string,
     *   category: integer,
     *   birthdate: string|null,
     *   phone: string,
     *   email: string|null
     * } $payload
     */
    public function execute(array $payload)
    {
        $session = session();

        $userAuthId = $session->get('userAuthId');
        $categoryBusiness = new CategoryBusiness();

        if (!$categoryBusiness->hasCategory($payload['category']))
            throw new Exceptions(\str_replace("{field}", lang("Words.category"),  lang("Validation.not_found")), BAD_BUSINESS_RULES);

        $clientsModel = new  ClientsModel();
        $clientCategoryModel = new ClientsCategoriesModel();
        $clientCategoryEntity = new ClientCategoryEntity();
        $clientEntity = new ClientEntity();

        $phone = str_replace(['+', '-', ' ', '(', ')'], '', $payload['phone']);
        $crypto = new Crypto();
        $systemKey = $crypto->encrypt($payload['name'] . ":" . $phone, getenv('system.encrypted_key'));

        $clientEntity->setSystemKey($systemKey);
        $clientEntity->setName($payload['name']);
        $clientEntity->setStatus('ACTIVE');
        $clientEntity->setPhoneSha256(\referenceHash($phone));
        $clientEntity->setOwnerId($userAuthId);
        $clientEntity->setEncryptPhone($phone);

        $foundClientWithPhone = $clientsModel->where(
            [
                "phone_sha256" => $clientEntity->getPhoneSha256(),
                "id !=" => $payload['id']
            ]
        )->first();
        if (!empty($foundClientWithPhone))
            throw new Exceptions(\str_replace("{field}", lang("Words.phone"),  lang("Api.clients.invalid.phone")), BAD_BUSINESS_RULES);

        if (!empty($payload['birthdate']))
            $clientEntity->setBirthdate($payload['birthdate']);
        if (!empty($payload['email']))
            $clientEntity->setEncryptEmail($payload['email']);
        else $clientEntity->setEmail($payload['email']);
        if (!empty($payload['avatar']))
            $clientEntity->setAvatar($payload['avatar']);

        $clientsModel->set($clientEntity->toArray(true))->where("id", $payload['id'])->update();

        $clientCategoryEntity->setClientId($payload['id']);
        $clientCategoryEntity->setCategoryId($payload['category']);

        $clientCategoryModel->set($clientCategoryEntity->toArray(true))->where("client_id", $payload['id'])->update();

        return (object)[
            "success" => lang("Api.clients.success.post")
        ];
    }
}
