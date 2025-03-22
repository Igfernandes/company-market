<?php

namespace App\Api\Invites\Users\Get;

use App\Database\Entities\Invites\InviteEntity;
use App\Database\Models\Invites\InvitesModel;
use App\Traits\Invites\InvitesDataTrait;

class GetUseCases
{
    use InvitesDataTrait;

    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     email: string, 
     *     email_contains: string, 
     *     is_valid: boolean, 
     *     created_at: string, 
     *     expired_at: string 
     * } $payload
     */
    public function execute(array $payload)
    {
        $session = session();

        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $invitesModel = new InvitesModel();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        $userAuthId = $session->get('userAuthId');

        if (count($in_ids) > 0)
            $invitesModel->whereIn("id", $in_ids);

        $filteredPayload['owner_id'] = $userAuthId;

        $foundInvite = $invitesModel->where($filteredPayload)->findAll();

        $invitesData = array_map(
            fn(InviteEntity $invite) => $this->builder($invite),
            $foundInvite
        );

        return \array_values($invitesData);
    }
}
