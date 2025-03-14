<?php

namespace App\Traits\Clients;

use App\Database\Entities\Clients\ClientEntity;

trait ClientsDataTrait
{
    public function builder(ClientEntity $clientEntity, array $clientCategories): Object
    {
        $categories = [];
        foreach ($clientCategories as $clientCategory) {
            if ($clientCategory->getClientId() == $clientEntity->getId()) {
                $category = $clientCategory->getCategory();

                array_push($categories, (object)[
                    "name" =>  $category->getName(),
                    "id" =>  $category->getId()
                ]);
            }
        }

        return  (object)[
            "id" => $clientEntity->getId(),
            "name" => $clientEntity->getName(),
            "email" => $clientEntity->getDecryptEmail(),
            "phone" => $clientEntity->getDecryptPhone(),
            "avatar" => $clientEntity->getAvatar(),
            "birthdate" => $clientEntity->getBirthdate(),
            "owner_id" => $clientEntity->getOwnerId(),
            "status" => $clientEntity->getStatus(),
            "categories" => $categories,
            "created_at" => $clientEntity->getCreatedAt(),
            "updated_at" => $clientEntity->getUpdatedAt()
        ];
    }
}
