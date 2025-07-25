<?php

namespace App\Business\Exports;

use App\Business\BaseBusiness;
use App\Business\Permissions\PermissionsBusiness;
use App\Database\Entities\Clients\ClientCategoryEntity;
use App\Database\Entities\Fields\ClientFieldEntity;
use App\Database\Entities\Fields\FieldsGroupEntity;
use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Database\Models\Fields\ClientsFieldsModel;
use App\Database\Models\Fields\FieldsGroupsModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;

class ExportsClientsBusiness
{
    use BaseBusiness;

    private ClientsFieldsModel $fieldsModel;
    private ClientsCategoriesModel $clientsCategoriesModel;
    private FieldsGroupsModel $fieldsGroupsModel;

    public function __construct()
    {
        $this->clientsCategoriesModel = new ClientsCategoriesModel();
        $this->fieldsModel = new ClientsFieldsModel();
        $this->fieldsGroupsModel = new FieldsGroupsModel();
    }

    /** 
     * @param array{int} $clientIds
     */
    public function getData(array $clientIds): array
    {
        \helper(["files", "string"]);

        $clientsFiltered = \array_filter($clientIds, fn($client) => !empty($client));
        $payload = [
            "in_ids" => $clientsFiltered
        ];

        $payload = PermissionsBusiness::applyOwnershipRestriction([
            'scope' => 'clients',
            'type' => 'VIEW'
        ], $payload);

        /** 
         * @var array{ClientCategoryEntity}
         */
        $foundClients = $this->clientsCategoriesModel->getClientsWithCategory($payload);
        /** 
         * @var array{ClientFieldEntity}
         */
        $foundFields = $this->fieldsModel->getClientsWithFields([
            "in_ids" => $clientsFiltered
        ]);
        $groups = $this->fieldsGroupsModel->where([
            "scope" => "CLIENT"
        ])->findAll();

        $clientsData = [];
        foreach ($foundClients as $key => $clientCategory) {
            $clientEntity = $clientCategory->getClient();

            if (empty($clientEntity))
                continue;

            $clientsData[$key] = [
                lang("Words.name") => $clientEntity->getName(),
                lang("Words.phone") => formatPhoneToText($clientEntity->getDecryptPhone()),
                "e-mail" => $clientEntity->getDecryptEmail()
            ];
            $clientsData[$key][lang("Words.category")] = $clientCategory->getCategory()->getName();

            $fieldsByClientId = \array_filter(
                $foundFields,
                fn(ClientFieldEntity $clientField)
                => $clientField->getClientId() === $clientEntity->getId()
            );

            $crypto = new Crypto();
            $systemEncryptedKey = getenv('system.encrypted_key');

            foreach ($fieldsByClientId as $clientField) {
                $fieldEntity = $clientField->getField();

                $groupCurrent = \array_values(array_filter($groups, fn(FieldsGroupEntity $group) => $group->getId() === $fieldEntity->getGroupId()));

                $encryptedKey =  "{$clientField->getClientId()}:$systemEncryptedKey";

                if ($fieldEntity->getType() === "FILE") {
                    $data = (object)[
                        "name" => $fieldEntity->getName(),
                        "value" => getPublicUrl($clientField->getValue())
                    ];
                } else {
                    $data = (object)[
                        "name" => $fieldEntity->getName(),
                        "value" => $fieldEntity->getIsSensitive() === 1 ? $crypto->decrypt($clientField->getValueEncrypted(),  $encryptedKey) : $clientField->getValue()
                    ];
                }

                if (\count($groupCurrent) === 0) {
                    $clientsData[$key]['fields']["OTHERS"][] = $data;
                } else {
                    $clientsData[$key]['fields'][$groupCurrent[0]->getName()][] = $data;
                }
            }
        }

        if (\count($clientsData) == 0)
            throw new Exceptions("Api.clients.invalid.not_found", NO_CONTENT);

        return [
            "title" => "clients",
            "clients" => \array_values($clientsData)
        ];
    }
}
