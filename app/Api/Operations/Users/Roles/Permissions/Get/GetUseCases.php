<?php

namespace App\Api\Operations\Users\Roles\Permissions\Get;

use App\Business\Users\UsersBusiness;
use App\Business\Users\UserSingleBusiness;
use App\Database\Entities\Permissions\RolePermissionsEntity;
use App\Database\Models\Permissions\RolesPermissionsModel;
use App\Traits\Users\PermissionsDataTrait;

class GetUseCases
{
    use PermissionsDataTrait;

    private UserSingleBusiness $userSingleBusiness;
    private UsersBusiness $usersBusiness;

    public function __construct()
    {
        $this->userSingleBusiness =  new UserSingleBusiness();
        $this->usersBusiness = new UsersBusiness();
    }

    /**
     * @param array{
     *     role_id: integer,
     *     limit: integer|undefined;
     *     start: integer|undefined;
     * } $payload
     */
    public function execute(array $payload)
    {
        $rolesPermissionsModel = new RolesPermissionsModel();

        $limit = isset($payload['limit']) ? \intval($payload['limit']) : 50;
        $startIndexRegister = isset($payload['start']) ? \intval($payload['start']) : 0;

        $foundRolesPermissions = $rolesPermissionsModel->limit($limit, $startIndexRegister)->getRolesWithPermissions([
            "id" => $payload['role_id']
        ]);

        return array_map(
            fn(RolePermissionsEntity $rolePermission) =>
            $this->builder($rolePermission->getPermission()),
            $foundRolesPermissions
        );
    }
}
