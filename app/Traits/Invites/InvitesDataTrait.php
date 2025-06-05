<?php

namespace App\Traits\Invites;

use App\Database\Entities\Invites\InviteEntity;
use App\Libraries\Crypto\Crypto;
use Exception;

trait InvitesDataTrait
{
    public function builder(InviteEntity $inviteEntity): Object
    {
        $crypto = new Crypto();
        /** @var object{
         *   name: string,
         *   email: string,
         *   phone: string,
         *   group: array{number}
         * }  */
        $dataDecrypted = $crypto->decrypt($inviteEntity->getData(), getenv('system.encrypted_key'));

        $data = \json_decode((string) $dataDecrypted);

        if (!isset($data->email))
            throw new Exception(lang("error: data->email"), \INTERNAL_ERROR);

        return  (object)[
            "id" => $inviteEntity->getId(),
            "email" => $data->email,
            "is_valid" => $inviteEntity->getIsValid(),
            "expired_at" => $inviteEntity->getExpiredAt(),
            "created_at" => $inviteEntity->getCreatedAt(),
        ];
    }
}
