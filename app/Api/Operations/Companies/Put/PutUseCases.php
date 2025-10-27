<?php

namespace App\Api\Operations\Companies\Put;

use App\Database\Entities\Companies\CompanyEntity;
use App\Database\Models\Companies\CompaniesModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;

class PutUseCases
{
    /**
     * @param array{
     *   id: integer,
     *   name: string,
     *   inscribed_at: string|null,
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

        $companyEntity->setSystemKey($systemKey);
        $companyEntity->setName($payload['name']);
        $companyEntity->setStatus('ACTIVE');
        $companyEntity->setPhoneSha256(\referenceHash($phone));
        $companyEntity->setOwnerId($userAuthId);
        $companyEntity->setEncryptPhone($phone);

        $foundWithPhone = $companiesModel->where(
            [
                "phone_sha256" => $companyEntity->getPhoneSha256(),
                "id !=" => $payload['id']
            ]
        )->first();
        if (!empty($foundWithPhone))
            throw new Exceptions("Api.companies.invalid.phone", BAD_BUSINESS_RULES);

        if (!empty($payload['birthdate']))
            $companyEntity->setInscribedAt($payload['birthdate']);
        if (!empty($payload['email']))
            $companyEntity->setEncryptEmail($payload['email']);
        else $companyEntity->setEmail($payload['email']);
        if (!empty($payload['logotype']))
            $companyEntity->setLogotype($payload['logotype']);

        $companiesModel->set($companyEntity->toArray(true))->where("id", $payload['id'])->update();

        NotificationsService::store([
            "scope" => "companies",
            "action" => "UPDATE",
            "key" =>  $payload['id']
        ]);
        return (object)[
            "success" => "Api.companies.success.put"
        ];
    }
}
