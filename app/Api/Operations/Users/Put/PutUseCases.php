<?php

namespace App\Api\Operations\Users\Put;

use App\Business\Authentications\AuthenticationBusiness;
use App\Business\Users\UsersBusiness;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;
use App\Traits\BusinessTrait;
use App\Traits\Services\ServicesDataTrait;
use CodeIgniter\HTTP\ResponseInterface;

class PutUseCases
{
    use ServicesDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: integer,
     *     name: string, 
     *     status: 'ACTIVE'|'INACTIVE',
     *     email: string,
     *     phone: string,
     *     document: string,
     *     keyword: string,
     *     birthdate: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $usersBusiness = new UsersBusiness();

        if (!$usersBusiness->isPhoneAvailable($payload['phone'], $payload['id']))
            throw new Exceptions("Api.users.invalid.already_exists_phone", ResponseInterface::HTTP_NOT_ACCEPTABLE);

        if (!$usersBusiness->isEmailAvailable($payload['email'], $payload['id']))
            throw new Exceptions("Api.users.invalid.already_exists_email", ResponseInterface::HTTP_NOT_ACCEPTABLE);

        if (!$usersBusiness->isDocumentAvailable($payload['document'], $payload['id']))
            throw new Exceptions("Api.users.invalid.already_exists_document", ResponseInterface::HTTP_NOT_ACCEPTABLE);

        $foundUser = $usersBusiness->hasUser([
            "id" => $payload['id']
        ]);

        if (empty($foundUser))
            throw new Exceptions("Api.users.invalid.not_found", ResponseInterface::HTTP_NOT_ACCEPTABLE);

        if (!empty($payload['id']))
            $usersBusiness->store($payload, $foundUser->getSystemKey());

        AuthenticationBusiness::revokeSession($foundUser);
        NotificationsService::store([
            "scope" => "users",
            "action" => "UPDATE"
        ]);

        return (object)[
            "success" => "Api.users.success.put"
        ];
    }
}
