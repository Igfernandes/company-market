<?php

namespace App\Database\Entities\CustomForms;

use App\Database\Entities\Clients\ClientEntity;
use CodeIgniter\Entity\Entity;

class ClientFormHistoryEntity extends Entity
{
    protected $dates = [];

    public $attributes = [
        'id'         => null,
        'form_id'    => null,
        'client_id'  => null,
        'package'    => null,
        'created_at' => null
    ];

    public $relations = [
        'client' => null,
        'form' => null
    ];

    public function getId(): ?int
    {
        return $this->attributes['id'];
    }

    public function setId(?int $id)
    {
        if (!empty($id))
            $this->attributes['id'] = $id;
    }

    public function getFormId(): ?int
    {
        return $this->attributes['form_id'];
    }

    public function setFormId(?int $formId)
    {
        if (!empty($formId))
            $this->attributes['form_id'] = $formId;
    }

    public function getClientId(): ?int
    {
        return $this->attributes['client_id'];
    }

    public function setClientId(?int $clientId)
    {
        if (!empty($clientId))
            $this->attributes['client_id'] = $clientId;
    }

    public function getPackage(): ?string
    {
        return $this->attributes['package'];
    }

    public function setPackage(?string $package)
    {
        if (!empty($package))
            $this->attributes['package'] = $package;
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt(?string $createdAt)
    {
        if (!empty($createdAt))
            $this->attributes['created_at'] = $createdAt;
    }

    // Client relation (if used)

    public function getClient(): ?ClientEntity
    {
        return $this->relations['client'];
    }

    public function setClient(ClientEntity $client)
    {
        if (!empty($client))
            $this->relations['client'] = $client;
    }

    public function getForm(): ?CustomFormEntity
    {
        return $this->relations['form'];
    }

    public function setForm(CustomFormEntity $form)
    {
        if (!empty($form))
            $this->relations['form'] = $form;
    }
}
