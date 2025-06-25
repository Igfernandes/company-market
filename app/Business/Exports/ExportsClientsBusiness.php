<?php

namespace App\Business\Exports;

use App\Business\BaseBusiness;
use App\Database\Entities\Clients\ClientCategoryEntity;
use App\Database\Entities\Fields\ClientFieldEntity;
use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Database\Models\Fields\ClientsFieldsModel;

class ExportsClientsBusiness
{
    use BaseBusiness;

    private ClientsFieldsModel $fieldsModel;
    private ClientsCategoriesModel $clientsCategoriesModel;

    public function __construct()
    {
        $this->clientsCategoriesModel = new ClientsCategoriesModel();
        $this->fieldsModel = new ClientsFieldsModel();
    }

    /** 
     * @param array{int} $clientIds
     */
    public function getData(array $clientIds): array
    {
        /** 
         * @var array{ClientCategoryEntity}
         */
        $foundClients = $this->clientsCategoriesModel->getClientsWithCategory([
            "in_ids" => $clientIds
        ]);
        /** 
         * @var array{ClientFieldEntity}
         */
        $foundFields = $this->fieldsModel->getClientsWithFields([
            "id" => $clientIds
        ]);

        $clientsData = [];
        foreach ($foundClients as $key => $clientCategory) {
            $clientEntity = $clientCategory->getClient();

            if (empty($clientEntity))
                continue;

            $clientsData[$key] = $clientEntity->toArray(true);
            $clientsData[$key]['category'] = $clientCategory->getCategory()->getName();

            $fieldsByClientId = \array_filter(
                $foundFields,
                fn(ClientFieldEntity $clientField)
                => $clientField->getClientId() === $clientEntity->getId()
            );

            $clientsData[$key]['fields'] = \array_map(function (ClientFieldEntity $clientField) {
                $fieldEntity = $clientField->getField();

                return (object)[
                    "name" => $fieldEntity->getName(),
                    "value" => $fieldEntity->getIsSensitive() ? $clientField->getValueEncrypted() : $clientField->getValue()
                ];
            }, $fieldsByClientId);
        }

        return $clientsData;
    }

}
