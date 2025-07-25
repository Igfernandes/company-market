<?php

namespace App\Database\Entities\CustomForms;

use CodeIgniter\Entity\Entity;

class FormFillEntity extends Entity
{
    protected $dates = [];
    protected $attributes = [
        'id'           => null,
        'form_id'      => null,
        'Packet'       => null,
        'value'        => null,
        'created_at'   => null
    ];

    public function getId(): ?int
    {
        return $this->attributes['id'];
    }

    public function setId(?int $id)
    {
        if (!empty($id)) {
            $this->attributes['id'] = $id;
        }
    }

    public function getFormId(): ?int
    {
        return $this->attributes['form_id'];
    }

    public function setFormId(?int $formId)
    {
        if (!empty($formId)) {
            $this->attributes['form_id'] = $formId;
        }
    }

    public function getFieldId(): ?int
    {
        return $this->attributes['field_id'];
    }

    public function setFieldId(?int $fieldId)
    {
        if (!empty($fieldId)) {
            $this->attributes['field_id'] = $fieldId;
        }
    }

    public function getPackage(): ?string
    {
        return $this->attributes['package'];
    }

    public function setPackage(?string $package)
    {
        $this->attributes['package'] = $package;
    }

    public function getValue(): ?string
    {
        return $this->attributes['value'];
    }

    public function setValue(?string $value)
    {
        $this->attributes['value'] = $value;
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt(?string $value)
    {
        if (!empty($value)) {
            $this->attributes['created_at'] = $value;
        }
    }
}
