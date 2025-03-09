<?php

namespace App\Api\Users\Get;

use App\Business\Users\UsersBusiness;
use App\Business\Users\UserSingleBusiness;

class GetUseCases
{
    private UserSingleBusiness $userSingleBusiness;
    private UsersBusiness $usersBusiness;

    public function __construct()
    {
        $this->userSingleBusiness =  new UserSingleBusiness();
        $this->usersBusiness = new UsersBusiness();
    }
    /**
     * @param array{
     *     current: string, 
     *     id: int,
     *     in_ids: array<int>, 
     *     name: string, 
     *     cpf: string, 
     *     phone: string, 
     *     birthdate: string, 
     *     status: 'ACTIVE' | 'INACTIVE', 
     *     created_at: string, 
     *     updated_at: string 
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredFields = \array_filter($payload, fn($field) => !empty($field));

        if (isset($filteredFields['id']) || isset($filteredFields['current']))
            return $this->userSingleBusiness->handler($filteredFields);
        else return $this->usersBusiness->handler($filteredFields);
    }
}
