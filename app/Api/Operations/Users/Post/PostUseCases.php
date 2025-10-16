<?php

namespace App\Api\Operations\Users\Post;

use App\Business\Users\Roles\RolesBusiness;
use App\Business\Users\UsersBusiness;
use App\Database\Entities\Invites\InviteEntity;
use App\Database\Entities\Users\UserEntity;
use App\Database\Entities\Users\UserRoleEntity;
use App\Database\Models\Invites\InvitesModel;
use App\Database\Models\Users\UsersModel;
use App\Database\Models\Users\UsersRolesModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;

class PostUseCases
{
    /**
     * @param array{
     *   document: string,
     *   password: string,
     *   birthdate: string,
     *   keyword: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $usersBusiness = new UsersBusiness();
        $document = \str_replace([".", "/", "-", "(", ")", "+"], '', $payload['document']);

        if (!$usersBusiness->isDocumentAvailable($document))
            throw new Exceptions("Api.users.invalid.already_exists_document", BAD_BUSINESS_RULES);

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

        if (!$usersBusiness->isEmailAvailable($dataInvite->email))
            throw new Exceptions("Api.users.invalid.already_exists_email", BAD_BUSINESS_RULES);

        $encryptedKey = $dataInvite->email . ":" . $payload['password'];
        $systemKey = $crypto->encrypt($encryptedKey, getenv('system.encrypted_key'));

        $userEntity->setSystemKey($systemKey);
        $userEntity->setName($dataInvite->name);
        $userEntity->setIsSocial(false);
        $userEntity->setStatus("ACTIVE");
        $userEntity->setEncryptDocument($document);
        $userEntity->setEncryptEmail($dataInvite->email);
        $userEntity->setEncryptPassword($payload['password']);
        $userEntity->setBirthdate($payload['birthdate']);
        $userEntity->setDocumentSha256(\referenceHash($document));
        $userEntity->setEmailSha256(\referenceHash($dataInvite->email));

        $usersModel->save($userEntity->toArray(true));

        $rolesBusiness = new RolesBusiness();
        $usersRolesModel = new UsersRolesModel();

        $userRoleEntity = new UserRoleEntity();
        $roleId = $dataInvite->role_id;

        if ($rolesBusiness->hasRole([
            "id" => $roleId
        ]));

        $userRoleEntity->setUserId($usersModel->getInsertID());
        $userRoleEntity->setRoleId($roleId);

        $usersRolesModel->save($userRoleEntity);


        $invitesModel->set(['is_valid' => false])->where("id", $foundInvite->getId())->update();

        return (object)[
            "success" => "Api.users.success.post"
        ];
    }
}
