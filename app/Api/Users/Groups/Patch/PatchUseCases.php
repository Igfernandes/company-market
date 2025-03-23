<?php

namespace App\Api\Users\Groups\Patch;

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

        if (!$groupsBusiness->hasClub([
            "id" => $groupId
        ]))
            throw new Exceptions(\str_replace("{field}", lang("Words.group"), lang("Validation.not_found")), \BAD_BUSINESS_RULES);

        $groupsModel = new GroupsModel();

        $foundGroup =  $groupsModel->where("id = $groupId")->first();

        $statusUpdate = $foundGroup->getStatus() === "ACTIVE" ? "INACTIVE" : "ACTIVE";

        $groupsModel->set("status", $statusUpdate)->update($groupId);

        return (object)[
            "success" => lang("Api.groups.success.status")
        ];
    }
}
