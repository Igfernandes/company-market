<?php

namespace App\Api\Operations\Companies\Post;

use App\Database\Entities\Companies\CompanyEntity;
use App\Database\Models\Companies\CompaniesModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;
use CodeIgniter\HTTP\Response;

class PostUseCases
{
    /**
     * @param array{
     *   name: string,
     *   inscribed_at: string|null,
     *   document: string|null,
     *   document_type: string|null,
     *   phone: string,
     *   email: string|null
     * } $payload
     */
    public function execute(array $payload)
    {
        $session = session();
        $userAuthId = $session->get('userAuthId');

        $companiesModel = new  CompaniesModel();
        $companyEntity = new CompanyEntity();

        $phone = str_replace(['+', '-', ' ', '(', ')'], '', $payload['phone']);

        $crypto = new Crypto();
        $systemKey = $crypto->encrypt($payload['name'] . ":" . $phone, getenv('system.encrypted_key'));

        $companyEntity->store($payload);
        $companyEntity->setSystemKey($systemKey);
        $companyEntity->setPhoneSha256(\referenceHash($phone));
        $companyEntity->setOwnerId($userAuthId);
        $companyEntity->setEncryptPhone($phone);

        $foundClientWithPhone = $companiesModel->where("phone_sha256", $companyEntity->getPhoneSha256())->first();
        if (!empty($foundClientWithPhone))
            throw new Exceptions("Api.companies.invalid.phone", Response::HTTP_NOT_ACCEPTABLE);

        if (!empty($payload['document']))
            $companyEntity->setEncryptDocument($payload['document']);

        $companiesModel->save($companyEntity);

        NotificationsService::store([
            "scope" => "companies",
            "action" => "CREATE",
            "key" => $companiesModel->getInsertID()
        ]);
        
        return (object)[
            "success" => "Api.companies.success.post"
        ];
    }
}
