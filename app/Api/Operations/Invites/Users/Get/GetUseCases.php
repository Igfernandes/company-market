<?php

namespace App\Api\Operations\Invites\Users\Get;

use App\Business\Users\Roles\RolesBusiness;
use App\Database\Entities\Invites\InviteEntity;
use App\Database\Entities\Users\UserEntity;
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
     *     expired_at: string,
     *     limit: int,
     *     start: int
     * } $payload
     */
    public function execute(array $payload)
    {
        $session = session();

        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $invitesModel = new InvitesModel();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        if (count($in_ids) > 0)
            $invitesModel->whereIn("id", $in_ids);

        /** @var UserEntity */
        $userAuth = $session->get(SESSION_KEY_AUTH_USER);

        if (!RolesBusiness::isAdministrator($userAuth->getId()))
            $filteredPayload['owner_id'] = $userAuth->getId();

        $limit = isset($payload['limit']) ? \intval($payload['limit']) : 50;
        $startIndexRegister = isset($payload['start']) ? \intval($payload['start']) : 0;
        unset($filteredPayload['limit']);
        unset($filteredPayload['start']);

        $foundInvite = $invitesModel->where($filteredPayload)->limit($limit, $startIndexRegister)->findAll();

        $invitesData = array_map(
            fn(InviteEntity $invite) => $this->builder($invite),
            $foundInvite
        );

        return \array_values($invitesData);
    }
}
