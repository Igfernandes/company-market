<?php

namespace App\Api\Users\Post;

use App\Business\Users\UsersBusiness;
use App\Database\Entities\Invites\InviteEntity;
use App\Database\Entities\Users\UserEntity;
use App\Database\Entities\Users\UserGroupsEntity;
use App\Database\Models\Invites\InvitesModel;
use App\Database\Models\Users\GroupsModel;
use App\Database\Models\Users\UsersGroupsModel;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;

class PostUseCases
{
    /**
     * @param array{
     *   cpf: string,
     *   password: string,
     *   birthdate: string,
     *   keyword: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $usersBusiness = new UsersBusiness();

        if (!$usersBusiness->isCPFAvailable($payload['cpf']))
            throw new Exceptions("Api.users.invalid.already_exists_cpf", BAD_AUTH);

        $invitesModel = new InvitesModel();

        /** @var InviteEntity */
        $foundInvite = $invitesModel->where([
            'is_valid' => true,
            'expired_at >' => date('Y-m-d H:i:s', strtotime('+0 day'))
        ])->first();

        if (empty($foundInvite))
            throw new Exceptions("Api.users.invalid.not_found_invite", \BAD_BUSINESS_RULES);

        $crypto = new Crypto();
        /** @var object{email:string,name:string,phone:string,group:array{int}} */
        $dataInvite = (object)\json_decode($crypto->decrypt($foundInvite->getData(),  getenv('system.encrypted_key')));

        $usersModel = new UsersModel();
        $userEntity = new UserEntity();

        $encryptedKey = $dataInvite->email . ":" . $payload['password'];
        $systemKey = $crypto->encrypt($encryptedKey, getenv('system.encrypted_key'));

        $userEntity->setSystemKey($systemKey);
        $userEntity->setName($dataInvite->name);
        $userEntity->setIsSocial(false);
        $userEntity->setStatus("ACTIVE");
        $userEntity->setPhoneSha256(\referenceHash($dataInvite->phone));
        $userEntity->setEncryptCpf($payload['cpf']);
        $userEntity->setEncryptEmail($dataInvite->email);
        $userEntity->setEncryptKeyword($payload['keyword']);
        $userEntity->setEncryptPassword($payload['password']);
        $userEntity->setEncryptPhone($dataInvite->phone);
        $userEntity->setBirthdate($payload['birthdate']);
        $userEntity->setCPFSha256(\referenceHash($payload['cpf']));
        $userEntity->setEmailSha256(\referenceHash($dataInvite->email));

        $usersModel->save($userEntity->toArray(true));

        $usersGroupsModel = new UsersGroupsModel();
        $groupsModel = new GroupsModel();

        foreach ($dataInvite->group as $groupId) {
            $usersGroupsEntity = new UserGroupsEntity();

            $foundGroup = $groupsModel->where(["id" => $groupId])->first();
            if (empty($foundGroup)) continue;

            $usersGroupsEntity->setUserId($usersModel->getInsertID());
            $usersGroupsEntity->setGroupId($groupId);

            $usersGroupsModel->save($usersGroupsEntity);
        }

        $invitesModel->set(['is_valid' => false])->where("id", $foundInvite->getId())->update();

        return (object)[
            "success" => "Api.users.success.post"
        ];
    }
}
