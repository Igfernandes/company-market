<?php

namespace App\Database\Entities\Services;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Entities\Services\ServiceEntity;
use CodeIgniter\Entity\Entity;

class ClientServiceEntity extends Entity
{

    protected $dates = [];
    public $attributes = [
        'service_id'        => null,
        'client_id'          => null,
        'is_confirm'        => null,
        "created_at"         => null
    ];
    public $relations = [
        'client' => null,
        'service' => null
    ];

    /**
     * getServiceId function
     *
     * @return Int|null
     */
    public function getServiceId(): ?Int
    {
        return $this->attributes['service_id'];
    }

    /**
     * setServiceId function
     *
     * @param Int|null $serviceId
     * @return void
     */
    public function setServiceId(Int $serviceId)
    {
        if (!empty($serviceId))
            $this->attributes['service_id'] = $serviceId;
    }

    /**
     * getService function
     *
     * @return ServiceEntity|null
     */
    public function getService(): ?ServiceEntity
    {
        return $this->relations['service'];
    }

    /**
     * setService function
     *
     * @param ServiceEntity|null $service
     * @return void
     */
    public function setService(ServiceEntity $service)
    {
        if (!empty($service))
            $this->relations['service'] = $service;
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
     * getIsConfirm function
     *
     * @return bool|null
     */
    public function getIsConfirm(): ?bool
    {
        return $this->attributes['is_confirm'];
    }

    /**
     * setIsConfirm function
     *
     * @param bool|null $isConfirm
     * @return void
     */
    public function setIsConfirm(bool $isConfirm)
    {
        if (!empty($isConfirm))
            $this->attributes['is_confirm'] = $isConfirm;
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
