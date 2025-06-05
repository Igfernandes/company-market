<?php

namespace App\Business\Clients;

use App\Business\BaseBusiness;
use App\Database\Entities\Fields\ClientFieldEntity;
use App\Database\Entities\Fields\FieldEntity;
use App\Database\Models\Clients\ClientsModel;
use App\Database\Models\Fields\ClientsFieldsModel;
use App\Database\Models\Fields\FieldsModel;

class ClientsByMetaBusiness
{
    use BaseBusiness;
    private ClientsModel $clientsModel;

    public function __construct()
    {
        $this->clientsModel = new ClientsModel();
    }

    /**
     * Processa uma lista de mensagens recebidas de diferentes plataformas.
     *
     * @param array<int, array{
     *     platform: string,   // Plataforma da mensagem, ex: "FACEBOOK"
     *     id: string,         // ID do usuário (PSID)
     *     user: ?object|null, // Objeto do usuário, pode ser null
     *     message: string     // Texto da mensagem recebida
     * }> $usersInfo
     */
    public function store(array $usersInfo): void
    {
        $clients = $this->clientsModel
            ->whereIn('phone_sha256', \array_map(fn($usersInfo) => $usersInfo['user'], $usersInfo))
            ->findAll();

        $clientsFieldsModel = new ClientsFieldsModel();
        $fieldsMeta = $this->getFieldsMeta();

        foreach ($clients as $client) {
            $foundUserInfo = \array_filter($usersInfo, fn($userInfo) => $userInfo['user'] == $client->getPhoneSha256());

            if (\count($foundUserInfo) == 0) continue;

            $userInfo = \array_values($foundUserInfo)[0];

            $clientEntity = new ClientFieldEntity();

            $clientEntity->setClientId($client->getId());
            $clientEntity->setValue($userInfo['id']);

            if (!isset($fieldsMeta[$userInfo['platform']])) continue;

            $fieldMetaEntity = $fieldsMeta[$userInfo['platform']];

            $clientEntity->setFieldId($fieldMetaEntity->getId());

            $clientsFieldsModel->upsert(["value" => $userInfo['id']], $clientEntity);
        }
    }


    public function getFieldsMeta()
    {
        $fieldsModel = new FieldsModel();
        $fieldEntity = new FieldEntity();
        $platforms = ['FACEBOOK_ID', 'INSTAGRAM_ID'];
        $metasFields = [];

        foreach ($platforms as $platform) {
            $fieldEntity->setComponent("INPUT");
            $fieldEntity->setIsSensitive(false);
            $fieldEntity->setIsRequired(false);
            $fieldEntity->setGroupId(4);
            $fieldEntity->setName($platform);

            $fieldId =  $fieldsModel->upsert(['name' => $platform], $fieldEntity);

            $fieldEntity->setId($fieldId);
            $metasFields[$platform] = $fieldEntity;
        }

        return $metasFields;
    }
}
