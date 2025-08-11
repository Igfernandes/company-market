<?php

namespace App\Api\Operations\Users\Groups\Patch;

use App\Business\Users\Groups\GroupsBusiness;
use App\Database\Models\Users\GroupsModel;
use App\Libraries\Exceptions\Exceptions;

class PatchUseCases
{
    /**
     * @param array{
     *   id: int
     * } $payload
     */
    public function execute(array $payload)
    {
        $groupsBusiness = new GroupsBusiness();

        $groupId = $payload['id'];

        if (!$groupsBusiness->hasGroup([
            "id" => $groupId
        ]))
            throw new Exceptions("Api.users.groups.invalid.not_found", \BAD_BUSINESS_RULES);

        $groupsModel = new GroupsModel();

        $foundGroup =  $groupsModel->where("id = $groupId")->first();

        $statusUpdate = $foundGroup->getStatus() === "ACTIVE" ? "INACTIVE" : "ACTIVE";

        $groupsModel->set("status", $statusUpdate)->update($groupId);

        return (object)[
            "success" => "Api.users.groups.success.status"
        ];
    }
}
