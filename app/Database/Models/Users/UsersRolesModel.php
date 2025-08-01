<?php

namespace App\Database\Models\Users;

use App\Database\Entities\Users\roleEntity;
use App\Database\Entities\Users\UserEntity;
use App\Database\Entities\Users\UserRoleEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class UsersRolesModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'users_roles';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\UserRoleEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['role_id', 'user_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getUsersWithRole(array $usersQuery, array $rolesQuery = []): array
    {
        $usersQueryUpdated = $this->addPrefixInQuery($usersQuery, "users");
        $rolesQueryUpdated = $this->addPrefixInQuery($rolesQuery, "roles");

        $inUserIds = isset($usersQuery['in_ids']) ? $usersQuery['in_ids'] : [];
        unset($usersQuery['in_ids']);

        if (count($inUserIds) > 0)
            $this->whereIn("user_id", $inUserIds);

        $inRolesIds = isset($rolesQuery['in_ids']) ? $rolesQuery['in_ids'] : [];
        unset($rolesQuery['in_ids']);

        if (count($inRolesIds) > 0)
            $this->whereIn("role_id", $inRolesIds);

        $founds = $this->Select("users.*, roles.*,
        users.name as user_name, users.id as user_id, users.created_at as user_created_at, 
        users.updated_at as user_updated_at,
        roles.name as role_name, roles.id as role_id, roles.created_at as role_created_at,
        roles.updated_at as role_updated_at")
            ->join("users", "users.id = users_roles.user_id", "left")
            ->join("roles", "roles.id = users_roles.role_id", "left")
            ->where($usersQueryUpdated)
            ->where($rolesQueryUpdated)->findAll();

        return array_map(function (UserRoleEntity $userRoleData) {
            $userRoleEntity = new UserRoleEntity();
            $userEntity = new UserEntity();
            $roleEntity = new RoleEntity();

            /** @var array */
            $attributes = $userRoleData->attributes;

            $userEntity->store($attributes);
            $userEntity->setId($attributes['user_id']);
            $userEntity->setName($attributes['user_name']);
            $userEntity->setCreatedAt($attributes['user_created_at']);
            $userEntity->setUpdatedAt($attributes['user_updated_at']);

            $roleEntity->store($attributes);
            $roleEntity->setId($attributes['role_id']);
            $roleEntity->setName($attributes['group_name']);
            $roleEntity->setCreatedAt($attributes['group_created_at']);
            $roleEntity->setUpdatedAt($attributes['group_updated_at']);

            $userRoleEntity->setUserId($attributes['user_id']);
            $userRoleEntity->setRoleId($attributes['role_id']);
            $userRoleEntity->setUser($userEntity);
            $userRoleEntity->setRole($roleEntity);

            return $userRoleEntity;
        }, $founds);
    }
}
