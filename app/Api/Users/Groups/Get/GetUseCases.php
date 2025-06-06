<?php

namespace App\Api\Users\Groups\Get;

use App\Database\Entities\Users\GroupEntity;
use App\Database\Models\Users\GroupsModel;

class GetUseCases
{
    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     name: string, 
     *     name_contains: string, 
     *     descriptions_contains: string,  
     *     status: 'ACTIVE' | 'INACTIVE', 
     *     created_at: string, 
     *     updated_at: string 
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $groupsModel = new GroupsModel();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);


        if (count($in_ids) > 0)
            $groupsModel->whereIn("id", $in_ids);

        /** @var GroupEntity */
        $foundGroups = $groupsModel->join("users_groups", "groups.id = users_groups.group_id", "left")
            ->select("groups.*, users_groups.user_id")->findAll();

        $groups = [];
        $amountUsersInGroup = [];

        foreach ($foundGroups as $group) {
            $groupEntity = new GroupEntity();
            $groupData = $group->attributes;

            $groupEntity->store($groupData);

            $groups[$group->getId()] = $groupEntity;

            if (!isset($groupData['user_id'])) {
                $amountUsersInGroup[$group->getId()] = 0;
                continue;
            }

            if (!isset($amountUsersInGroup[$groupData['user_id']]))
                $amountUsersInGroup[$group->getId()] = 1;
            else $amountUsersInGroup[$group->getId()] += 1;
        }

        $groupsData = array_map(
            fn(GroupEntity $group) => (object)[
                "id" => $group->getId(),
                "name" => $group->getName(),
                "status" => $group->getStatus(),
                "description" => $group->getDescription(),
                "total" => $amountUsersInGroup[$group->getId()],
                "created_at" => $group->getCreatedAt(),
                "updated_at" => $group->getUpdatedAt()
            ],
            $groups
        );

        return \array_values($groupsData);
    }
}
