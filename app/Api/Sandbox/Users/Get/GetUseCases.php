<?php

namespace App\Api\Sandbox\Users\Get;

class GetUseCases
{

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
            return GetMock::get()[0];
        else return GetMock::get();
    }
}
