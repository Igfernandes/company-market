<?php

namespace App\Api\Invites\Users\Delete;

use App\Database\Entities\Invites\InviteEntity;
use App\Database\Models\Invites\InvitesModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;

class DeleteUseCases
{
    /**
     * @param array{
     *   id: integer
     * } $payload
     */
    public function execute(array $payload)
    {
        $invitesModel = new InvitesModel();

        $inviteId = $payload['id'];
        /** @var InviteEntity */
        $foundInvite = $invitesModel->where("id = $inviteId")->first();

        if (empty($foundInvite))
            throw new Exceptions( "Api.invites.invalid.not_found", \BAD_BUSINESS_RULES);

        $invitesModel->where("id = $inviteId")->delete();

        NotificationsService::store([
            "scope" => "invites",
            "action" => "DELETE"
        ]);

        return (object)[
            "success" => "Api.invites.success.delete"
        ];
    }
}
