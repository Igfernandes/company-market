<?php

namespace App\Services\MercadoPago\Operations;

use App\Database\Entities\Reports\OperationFailureEntity;
use App\Libraries\Cerberus\Cerberus;
use App\Services\MercadoPago\DTOs\UserDTO;
use App\Services\MercadoPago\ReportsUserConstants;
use MercadoPago\SDK;

class Authentication
{
    private UserDTO $userAuth;
    private string $accessToken;
    private Cerberus $cerberus;

    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->userAuth = $this->auth($accessToken);
        $this->cerberus = new Cerberus();
    }

    public function auth(): UserDTO
    {
        SDK::setAccessToken($this->accessToken);

        // Primeiro, obtém o user_id
        $response = SDK::get('/users/me');

        if (!isset($response['body'])) {
            $operationFailure = new OperationFailureEntity();
            $data = ReportsUserConstants::$NOT_FOUND_USER;

            $data['payload_sent'] = \json_encode((object)[
                "field" => "accessToken"
            ]);
            $operationFailure->store($data);

            $this->cerberus->report($operationFailure);
        }

        $userInfoDTO = new UserDTO($response['body']);

        return $userInfoDTO;
    }

    public function getUser()
    {
        $user = $this->userAuth;
        if (empty($user))
            $this->getUser();

        return $this->userAuth;
    }
}
