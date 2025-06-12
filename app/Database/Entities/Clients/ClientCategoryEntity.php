<?php

namespace App\Database\Entities\Clients;

use App\Database\Entities\Clients\CategoryEntity;
use App\Database\Entities\Clients\ClientEntity;
use CodeIgniter\Entity\Entity;

class ClientCategoryEntity extends Entity
{

    protected $dates = [];
    public $attributes = [
        'category_id'        => null,
        'client_id'          => null,
        "created_at"         => null
    ];
    public $relations = [
        'client' => null,
        'category' => null
    ];

    /**
     * getCategoryId function
     *
     * @return Int|null
     */
    public function getCategoryId(): ?Int
    {
        return $this->attributes['category_id'];
    }

    /**
     * setCategoryId function
     *
     * @param Int|null $categoryId
     * @return void
     */
    public function setCategoryId(Int $categoryId)
    {
        if (!empty($categoryId))
            $this->attributes['category_id'] = $categoryId;
    }

    /**
     * getCategory function
     *
     * @return CategoryEntity|null
     */
    public function getCategory(): ?CategoryEntity
    {
        return $this->relations['category'];
    }

    /**
     * setCategory function
     *
     * @param CategoryEntity|null $client
     * @return void
     */
    public function setCategory(CategoryEntity $category)
    {
        if (!empty($category))
            $this->relations['category'] = $category;
    }

    /**
     * getClientId function
     *
     * @return Int|null
     */
    public function getClientId(): ?Int
    {
        return $this->attributes['client_id'];
    }

    /**
     * setClientId function
     *
     * @param Int|null $clientId
     * @return void
     */
    public function setClientId(Int $clientId)
    {
        if (!empty($clientId))
            $this->attributes['client_id'] = $clientId;
    }

    /**
     * getClient function
     *
     * @return ClientEntity|null
     */
    public function getClient(): ?ClientEntity
    {
        return $this->attributes['client'];
    }

    /**
     * setClient function
     *
     * @param ClientEntity|null $client
     * @return void
     */
    public function setClient(ClientEntity $client)
    {
        if (!empty($client))
            $this->attributes['client'] = $client;
    }

    /**
     * setCreatedAt function
     *
     * @param String|null $createdAt
     * @return void
     */
    public function setCreatedAt(?String $createdAt)
    {
        if (!empty($createdAt))
            $this->attributes['created_at'] = $createdAt;
    }

    /**
     * getCreatedAt function
     *
     * @return String|null
     */
    public function getCreatedAt(): ?String
    {
        return $this->attributes['created_at'];
    }
}
