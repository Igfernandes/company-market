<?php

namespace App\Business\Users;

use App\Business\BaseBusiness;
use App\Database\Entities\Users\UserGroupsEntity;
use App\Database\Models\Users\GroupsModel;
use App\Database\Models\Users\UsersGroupsModel;

class UsersGroupsBusiness
{
    use BaseBusiness;
    /**
     * @param array{Int} $groups
     */
    public function hasGroups(array $groups): bool
    {
        $groupsModel = new GroupsModel();

        if (!is_array($groups))
            return false;

        $foundGroups = $groupsModel->whereIn("id", $groups)->findAll();

        return count($foundGroups) == count($groups);
    }

    public function store(array $groups, UserGroupsEntity $entity, UsersGroupsModel $model)
    {
        foreach ($groups as $group) {
            $entity->setGroupId($group);

            $model->save($entity);
        }
    }
}
