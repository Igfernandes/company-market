<?php

namespace App\Api\Operations\Clients\Post;

use App\Business\Clients\CategoryBusiness;
use App\Database\Entities\Clients\ClientCategoryEntity;
use App\Database\Entities\Clients\ClientEntity;
use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Database\Models\Clients\ClientsModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;

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
            throw new Exceptions("Api.clients.invalid.not_found_category", BAD_BUSINESS_RULES);

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

        $foundClientWithPhone = $clientsModel->where("phone_sha256", $clientEntity->getPhoneSha256())->first();
        if (!empty($foundClientWithPhone))
            throw new Exceptions("Api.clients.invalid.phone", BAD_BUSINESS_RULES);

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

        NotificationsService::store([
            "scope" => "clients",
            "action" => "CREATE",
            "key" => $clientsModel->getInsertID()
        ]);
        return (object)[
            "success" => "Api.clients.success.post"
        ];
    }
}
