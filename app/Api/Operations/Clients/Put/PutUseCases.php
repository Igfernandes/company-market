<?php

namespace App\Api\Operations\Clients\Put;

use App\Business\Clients\CategoryBusiness;
use App\Business\Clients\ClientsBusiness;
use App\Database\Entities\Clients\ClientCategoryEntity;
use App\Database\Entities\Clients\ClientEntity;
use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Database\Models\Clients\ClientsModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;
use CodeIgniter\HTTP\Response;

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

        if (!$categoryBusiness->has([
            "id" => $payload['category']
        ]))
            throw new Exceptions("Api.clients.invalid.not_found_category", Response::HTTP_NOT_ACCEPTABLE);

        $clientsBusiness = new ClientsBusiness();
        if (!$clientsBusiness->has([
            "id" => $payload['id']
        ]))
            throw new Exceptions("Api.clients.invalid.not_found", Response::HTTP_NOT_ACCEPTABLE);



        $clientsModel = new  ClientsModel();
        $clientCategoryModel = new ClientsCategoriesModel();
        $clientCategoryEntity = new ClientCategoryEntity();
        $clientEntity = new ClientEntity();

        $phone = str_replace(['+', '-', ' ', '(', ')'], '', $payload['phone']);
        $crypto = new Crypto();
        $systemKey = $crypto->encrypt($payload['name'] . ":" . $phone, getenv('system.encrypted_key'));

        $clientEntity->store($payload);
        $clientEntity->setSystemKey($systemKey);
        $clientEntity->setName($payload['name']);
        $clientEntity->setStatus('ACTIVE');
        $clientEntity->setCompanyId($payload['company']);
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
            throw new Exceptions("Api.clients.invalid.phone", Response::HTTP_NOT_ACCEPTABLE);

        if (!empty($payload['document']))
            $clientEntity->setEncryptDocument($payload['document']);

        if (!empty($payload['email']))
            $clientEntity->setEncryptEmail($payload['email']);

        $clientsModel->set($clientEntity->toArray(true))->where("id", $payload['id'])->update();

        $clientCategoryEntity->setClientId($payload['id']);
        $clientCategoryEntity->setCategoryId($payload['category']);

        $clientCategoryModel->set($clientCategoryEntity->toArray(true))->where("client_id", $payload['id'])->update();

        NotificationsService::store([
            "scope" => "clients",
            "action" => "UPDATE",
            "key" =>  $payload['id']
        ]);
        return (object)[
            "success" => "Api.clients.success.put"
        ];
    }
}
