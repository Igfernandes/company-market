<?php

namespace App\Api\Invites\Users\Delete;

use App\Database\Entities\Invites\InviteEntity;
use App\Database\Models\Invites\InvitesModel;
use App\Libraries\Exceptions\Exceptions;

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
            throw new Exceptions(\str_replace("{field}", lang("Words.invite"), lang("Validation.not_found")), \BAD_BUSINESS_RULES);

        $invitesModel->where("id = $inviteId")->delete();

        return (object)[
            "success" => lang("Api.invites.success.resend")
        ];
    }
}
