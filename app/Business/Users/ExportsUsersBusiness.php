<?php

namespace App\Business\Users;

use App\Business\BaseBusiness;
use App\Business\Permissions\PermissionsValidationBusiness;
use App\Database\Entities\Fields\ClientFieldEntity;
use App\Database\Entities\Fields\FieldsGroupEntity;
use App\Database\Entities\Users\UserEntity;
use App\Database\Entities\Users\UserFieldEntity;
use App\Database\Entities\Users\UserRoleEntity;
use App\Database\Models\Fields\FieldsGroupsModel;
use App\Database\Models\Users\UsersFieldsModel;
use App\Database\Models\Users\UsersRolesModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;
use CodeIgniter\HTTP\ResponseInterface;

class ExportsUsersBusiness
{
    use BaseBusiness;

    private UsersFieldsModel $fieldsModel;
    private UsersRolesModel $usersRolesModel;
    private FieldsGroupsModel $fieldsGroupsModel;

    public function __construct()
    {
        $this->usersRolesModel = new UsersRolesModel();
        $this->fieldsModel = new UsersFieldsModel();
        $this->fieldsGroupsModel = new FieldsGroupsModel();
    }

    /** 
     * @param null|array{int} $userIds
     */
    public function getData(?array $userIds): array
    {
        \helper(["files", "string"]);

        $usersFiltered = \array_filter($userIds, fn($user) => !empty($user));
        $payload = [];

        if (\count($userIds) > 0) {
            $payload["in_ids"] = $usersFiltered;
        }

        $payload = PermissionsValidationBusiness::applyOwnershipRestriction([
            'scope' => 'users',
            'type' => 'VIEW'
        ], $payload);

        /** 
         * @var array{UserRoleEntity}
         */
        $foundUsers = $this->usersRolesModel->getUsersWithRole($payload);
        /** 
         * @var array{ClientFieldEntity}
         */
        $foundFields = $this->fieldsModel->getUsersWithFields([
            "in_ids" => $usersFiltered
        ]);
        $groups = $this->fieldsGroupsModel->where([
            "scope" => "USER"
        ])->findAll();

        $usersData = [];
        foreach ($foundUsers as $key => $userRole) {
            /** @var UserEntity */
            $userEntity = $userRole->getUser();

            if (empty($userEntity))
                continue;

            $usersData[$key] = [
                lang("Words.name") => $userEntity->getName(),
                lang("Words.phone") => formatPhoneToText($userEntity->getDecryptPhone()),
                "e-mail" => $userEntity->getDecryptEmail(),
                "status" => $userEntity->getStatus(),
                $userEntity->getDocumentType() => $userEntity->getDecryptDocument(),

            ];
            $usersData[$key][lang("Words.role")] = $userRole->getRole()->getName();

            $fieldsByUserId = \array_filter(
                $foundFields,
                fn(UserFieldEntity $userField)
                => $userField->getUserId() === $userEntity->getId()
            );

            $crypto = new Crypto();
            $systemEncryptedKey = getenv('system.encrypted_key');

            foreach ($fieldsByUserId as $UserField) {
                $fieldEntity = $UserField->getField();

                $groupCurrent = \array_values(array_filter($groups, fn(FieldsGroupEntity $group) => $group->getId() === $fieldEntity->getGroupId()));

                $encryptedKey =  "{$UserField->getClientId()}:$systemEncryptedKey";

                if ($fieldEntity->getType() === "FILE") {
                    $data = (object)[
                        "name" => $fieldEntity->getName(),
                        "value" => getPublicUrl($UserField->getValue())
                    ];
                } else {
                    if ($fieldEntity->getIsSensitive() === 1) {
                        $value = $crypto->decrypt($UserField->getValueEncrypted(),  $encryptedKey);
                    } else {
                        $value = $UserField->getValue();
                    }

                    $data = (object)[
                        "name" => $fieldEntity->getName(),
                        "value" => $value
                    ];
                }

                if (\count($groupCurrent) === 0) {
                    $usersData[$key]['fields']["OTHERS"][] = $data;
                } else {
                    $usersData[$key]['fields'][$groupCurrent[0]->getName()][] = $data;
                }
            }
        }

        if (\count($usersData) == 0)
            throw new Exceptions("Api.users.invalid.not_found", ResponseInterface::HTTP_NO_CONTENT);

        return [
            "title" => "users",
            "users" => \array_values($usersData)
        ];
    }
}
