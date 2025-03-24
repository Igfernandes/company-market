<?php

namespace App\Database\Models\Users;

use App\Database\Entities\Users\GroupEntity;
use App\Database\Entities\Users\UserEntity;
use App\Database\Entities\Users\UserGroupsEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class UsersModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\UserEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'username', 'email', 'password', 'photo', 'cpf', 'phone', 'birthdate', 'keyword', 'status', 'email_sha1', 'phone_sha1', 'cpf_sha1', 'twof_secret', 'system_key', 'created_at', 'updated_at'];
    protected $useSoftDeletes = true;

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getUsersWithGroup(array $usersQuery): array
    {
        $usersQueryUpdated = $this->addPrefixInQuery($usersQuery, "users");

        $inUserIds = isset($usersQuery['in_ids']) ? $usersQuery['in_ids'] : [];
        unset($usersQuery['in_ids']);

        if (count($inUserIds) > 0)
            $this->whereIn("user_id", $inUserIds);


        $founds = $this->select("users.*, groups.*,
        users.name as user_name, users.id as user_id, users.created_at as user_created_at, 
        users.status as user_status, users.updated_at as user_updated_at,
        groups.name as group_name, groups.id as group_id, groups.status as group_status, groups.created_at as group_created_at,
        groups.updated_at as group_updated_at")
            ->join("users_groups", "users.id = users_groups.user_id", "left")
            ->join("groups", "groups.id = users_groups.group_id", "left")
            ->where($usersQueryUpdated)->findAll();

        return array_map(function (UserEntity $userData) {
            $userGroupEntity = new UserGroupsEntity();
            $userEntity = new UserEntity();
            $groupEntity = new GroupEntity();

            /** @var array */
            $attributes = $userData->attributes;

            $userEntity->setStore($attributes);
            $userEntity->setId($attributes['user_id']);
            $userEntity->setName($attributes['user_name']);
            $userEntity->setStatus($attributes['user_status']);
            $userEntity->setCreatedAt($attributes['user_created_at']);
            $userEntity->setUpdatedAt($attributes['user_updated_at']);

            if (isset($attributes['group_id'])) {
                $groupEntity->setStore($attributes);
                $groupEntity->setId($attributes['group_id']);
                $groupEntity->setName($attributes['group_name']);
                $groupEntity->setStatus($attributes['group_status']);
                $groupEntity->setCreatedAt($attributes['group_created_at']);
                $groupEntity->setUpdatedAt($attributes['group_updated_at']);

                $userGroupEntity->setUserId($attributes['user_id']);
                $userGroupEntity->setGroupId($attributes['group_id']);

                $userGroupEntity->setGroup($groupEntity);
            }

            $userGroupEntity->setUser($userEntity);

            return $userGroupEntity;
        }, $founds);
    }
}
