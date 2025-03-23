<?php

namespace App\Database\Models\Clients;

use App\Database\Entities\Clients\CategoryEntity;
use App\Database\Entities\clients\ClientCategoryEntity;
use App\Database\Entities\Clients\ClientEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class ClientsCategoriesModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'clients_categories';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Clients\ClientCategoryEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['category_id', 'client_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function getClientsWithCategory(array $clientQuery, array $CategoryQuery = []): array
    {
        $clientQueryUpdated = $this->addPrefixInQuery($clientQuery, "clients");
        $categoryQueryUpdated = $this->addPrefixInQuery($CategoryQuery, "categories");

        $founds = $this->Select(" clients.*, categories.*,
        clients.name as client_name, clients.id as client_id, clients.created_at as client_created_at, 
        clients.updated_at as client_updated_at,
        categories.name as category_name, categories.id as category_id, categories.created_at as category_created_at,
        categories.updated_at as category_updated_at")
            ->join("clients", "clients.id = clients_categories.client_id")
            ->join("categories", "categories.id = clients_categories.category_id")
            ->where($clientQueryUpdated)
            ->where($categoryQueryUpdated)->findAll();

        return array_map(function (ClientCategoryEntity $clientCategoryData) {
            $clientCategory = new ClientCategoryEntity();
            $clientEntity = new ClientEntity();
            $categoryEntity = new CategoryEntity();

            /** @var array */
            $attributes = $clientCategoryData->attributes;

            $clientEntity->setStore($attributes);
            $clientEntity->setId($attributes['client_id']);
            $clientEntity->setName($attributes['client_name']);
            $clientEntity->setCreatedAt($attributes['client_created_at']);
            $clientEntity->setUpdatedAt($attributes['client_updated_at']);

            $categoryEntity->setStore($attributes);
            $categoryEntity->setId($attributes['category_id']);
            $categoryEntity->setName($attributes['category_name']);
            $categoryEntity->setCreatedAt($attributes['category_created_at']);
            $categoryEntity->setUpdatedAt($attributes['category_updated_at']);

            $clientCategory->setClientId($attributes['client_id']);
            $clientCategory->setCategoryId($attributes['category_id']);
            $clientCategory->setClient($clientEntity);
            $clientCategory->setCategory($categoryEntity);

            return $clientCategory;
        }, $founds);
    }
}
