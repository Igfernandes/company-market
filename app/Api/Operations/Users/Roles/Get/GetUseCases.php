<?php

namespace App\Api\Operations\Users\Roles\Get;

use App\Business\Users\UsersBusiness;
use App\Business\Users\UserSingleBusiness;
use App\Database\Entities\Users\RoleEntity;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\RolesModel;
use App\Database\Models\Users\UsersRolesModel;
use App\Traits\BusinessTrait;
use App\Traits\Users\RolesDataTrait;

class GetUseCases
{
    use RolesDataTrait, BusinessTrait;

    private UserSingleBusiness $userSingleBusiness;
    private UsersBusiness $usersBusiness;

    public function __construct()
    {
        $this->userSingleBusiness =  new UserSingleBusiness();
        $this->usersBusiness = new UsersBusiness();
    }
    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     name: string, 
     *     name_contains: string, 
     *     describe_contains: string, 
     *     status: 'ACTIVE'|'INACTIVE',
     *     limit: integer|undefined;
     *     start: integer|undefined;
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredFields = \array_filter($payload, fn($field) => !empty($field));

        $rolesModel = new RolesModel();
        $rolesEntity = new RoleEntity();

        $rolesEntity->store($filteredFields);
        $rolesModel =  $this->builderClauseWithContains($filteredPayload ?? [], $rolesModel);

        $limit = isset($filteredFields['limit']) ? \intval($filteredFields['limit']) : 50;
        $startIndexRegister = isset($filteredFields['start']) ? \intval($filteredFields['start']) : 0;

        $query = $rolesEntity->toArray(true);

        if (count($query) > 0)
            $rolesModel->where($query);

        $foundRoles = $rolesModel->limit($limit, $startIndexRegister)->findAll();
        $usersRolesModel = new UsersRolesModel();
        $foundRelations =  $usersRolesModel->whereIn("role_id", \array_map(fn(RoleEntity $role) => $role->getId(),  $foundRoles))->findAll();

        if (isset($filteredFields['id']) || isset($filteredFields['current']))
            return $this->builder($foundRoles[0],  $foundRelations);

        return array_map(fn(RoleEntity $role) => $this->builder($role,  $foundRelations), $foundRoles);
    }
}
