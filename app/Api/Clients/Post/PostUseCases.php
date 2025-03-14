<?php

namespace App\Api\Clients\Post;

use App\Business\Clients\CategoryBusiness;
use App\Database\Entities\clients\ClientCategoryEntity;
use App\Database\Entities\Clients\ClientEntity;
use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Database\Models\Clients\ClientsModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;

class PostUseCases
{
    /**
     * @param array{
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

        $crypto = new Crypto();
        $systemKey = $crypto->encrypt($payload['name'] . ":" . $payload['phone'], getenv('system.encrypted_key'));

        $clientEntity->setSystemKey($systemKey);
        $clientEntity->setName($payload['name']);
        $clientEntity->setStatus('ACTIVE');
        $clientEntity->setPhoneSha1(\sha1($payload['phone']));
        $clientEntity->setOwnerId($userAuthId);
        $clientEntity->setEncryptPhone($payload['phone']);

        $foundClientWithPhone = $clientsModel->where("phone_sha1", $clientEntity->getPhoneSha1())->first();
        if (!empty($foundClientWithPhone))
            throw new Exceptions(\str_replace("{field}", lang("Words.phone"),  lang("Api.clients.invalid.phone")), BAD_BUSINESS_RULES);

        if (!empty($payload['birthdate']))
            $clientEntity->setBirthdate($payload['birthdate']);
        if (!empty($payload['email']))
            $clientEntity->setEncryptEmail($payload['email']);
        if (!empty($payload['avatar']))
            $clientEntity->setAvatar($payload['avatar']);

        $clientsModel->save($clientEntity);

        $clientCategoryEntity->setClientId($clientsModel->getInsertID());
        $clientCategoryEntity->setCategoryId($payload['category']);

        $clientCategoryModel->save($clientCategoryEntity);

        return (object)[
            "success" => lang("Api.clients.success.post")
        ];
    }
}
