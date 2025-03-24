<?php

namespace App\Database\Models\Users;

use App\Database\Entities\Users\GroupEntity;
use App\Database\Entities\Users\UserEntity;
use App\Database\Entities\Users\UserGroupsEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class UsersGroupsModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'users_groups';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\UserGroupsEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['group_id', 'user_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getUsersWithGroup(array $usersQuery, array $groupsQuery = []): array
    {
        $usersQueryUpdated = $this->addPrefixInQuery($usersQuery, "users");
        $groupsQueryUpdated = $this->addPrefixInQuery($groupsQuery, "groups");

        $inUserIds = isset($usersQuery['in_ids']) ? $usersQuery['in_ids'] : [];
        unset($usersQuery['in_ids']);

        if (count($inUserIds) > 0)
            $this->whereIn("user_id", $inUserIds);

        $inGroupIds = isset($groupsQuery['in_ids']) ? $groupsQuery['in_ids'] : [];
        unset($groupsQuery['in_ids']);

        if (count($inGroupIds) > 0)
            $this->whereIn("group_id", $inGroupIds);

        $founds = $this->Select("users.*, groups.*,
        users.name as user_name, users.id as user_id, users.created_at as user_created_at, 
        users.updated_at as user_updated_at,
        groups.name as group_name, groups.id as group_id, groups.created_at as group_created_at,
        groups.updated_at as group_updated_at")
            ->join("users", "users.id = users_groups.user_id", "left")
            ->join("groups", "groups.id = users_groups.group_id", "left")
            ->where($usersQueryUpdated)
            ->where($groupsQueryUpdated)->findAll();

        return array_map(function (UserGroupsEntity $userGroupData) {
            $userGroupEntity = new UserGroupsEntity();
            $userEntity = new UserEntity();
            $groupEntity = new GroupEntity();

            /** @var array */
            $attributes = $userGroupData->attributes;

            $userEntity->setStore($attributes);
            $userEntity->setId($attributes['user_id']);
            $userEntity->setName($attributes['user_name']);
            $userEntity->setCreatedAt($attributes['user_created_at']);
            $userEntity->setUpdatedAt($attributes['user_updated_at']);

            $groupEntity->setStore($attributes);
            $groupEntity->setId($attributes['group_id']);
            $groupEntity->setName($attributes['group_name']);
            $groupEntity->setCreatedAt($attributes['group_created_at']);
            $groupEntity->setUpdatedAt($attributes['group_updated_at']);

            $userGroupEntity->setUserId($attributes['user_id']);
            $userGroupEntity->setGroupId($attributes['group_id']);
            $userGroupEntity->setUser($userEntity);
            $userGroupEntity->setGroup($groupEntity);

            return $userGroupEntity;
        }, $founds);
    }
}
