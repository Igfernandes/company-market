<?php

namespace App\Traits\Clients;

use App\Database\Entities\Services\ClientServiceEntity;

trait ClientsServiceDataTrait
{
    public function clientWithServices(ClientServiceEntity $clientServiceEntity, array $clientCategories): Object
    {
        $categories = [];
        foreach ($clientCategories as $clientCategory) {
            if ($clientCategory->getClientId() == $clientServiceEntity->getClientId()) {
                $category = $clientCategory->getCategory();

                array_push($categories, (object)[
                    "name" =>  $category->getName(),
                    "id" =>  $category->getId()
                ]);
            }
        }
        $client = $clientServiceEntity->getClient();
        return  (object)[
            "id" => $client->getId(),
            "name" => $client->getName(),
            "phone" => $client->getDecryptPhone(),
            "categories" => $categories,
            "is_confirm" => $clientServiceEntity->getIsConfirm(),
            "service" => [
                "id" => $clientServiceEntity->getServiceId(),
                "name" => $clientServiceEntity->getService()->getName()
            ]
        ];
    }
}
