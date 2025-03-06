<?php

namespace App\Database\Entities\Users;

use App\Database\Entities\CustomForms\CustomFormsEntity;
use CodeIgniter\Entity\Entity;

class UsersFieldsEntity extends Entity
{
    protected $dates = [
        "created_at"      => null,
        "updated_at"      => null,
    ];
    public $attributes = [
        'id'              => null,
        'label'           => null,
        'value'           => null,
        'form_id'         => null,
        'form'            => null,
        'user_id'         => null,
        'user'            => null
    ];

    /**
     * @method mixed getId()
     *
     * @return Int|null
     */
    public function getId(): ?Int
    {
        return $this->attributes['id'];
    }

    /**
     * @method mixed setId()
     *
     * @param Int|null $id
     * @return void
     */
    public function setId(?Int $id)
    {
        if (!empty($id))
            $this->attributes['id'] = $id;
    }

    /**
     * @method getLabel function
     *
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->attributes['label'];
    }

    /**
     * @param setLabel function
     *
     * @param string|null $label
     * @return void
     */
    public function setLabel(?string $label)
    {
        if (!empty($label))
            $this->attributes['label'] = $label;
    }

    /**
     * @method getValue function
     *
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->attributes['value'];
    }

    /**
     * @param setValue function
     *
     * @param Json|string|null $value
     * @return void
     */
    public function setValue(?string $value)
    {
        if (!empty($value))
            $this->attributes['value'] = $value;
    }

    /**
     * @method getFormId function
     *
     * @return Int|null
     */
    public function getFormId(): ?Int
    {
        return $this->attributes['form_id'];
    }

    /**
     * @method setFormId function
     *
     * @param Int|null $formId
     * @return void
     */

    public function setFormId(Int $formId)
    {
        if (!empty($formId))
            $this->attributes['form_id'] = $formId;
    }
    /**
     * @method getForm function
     *
     * @return CustomFormsEntity|null
     */
    public function getForm(): ?CustomFormsEntity
    {
        return $this->attributes['form'];
    }

    /**
     * @method setForm function
     *
     * @param CustomFormsEntity|null $form
     * @return void
     */
    public function setForm(CustomFormsEntity $form)
    {
        if (!empty($form))
            $this->attributes['form'] = $form;
    }


    /**
     * @method getUserId function
     *
     * @return Int|null
     */
    public function getUserId(): ?Int
    {
        return $this->attributes['user_id'];
    }

    /**
     * @method setUserId function
     *
     * @param Int|null $userId
     * @return void
     */
    public function setUserId(Int $userId)
    {
        if (!empty($userId))
            $this->attributes['user_id'] = $userId;
    }

    /**
     * @method getUser function
     *
     * @return UsersEntity|null
     */
    public function getUser(): ?UsersEntity
    {
        return $this->attributes['user'];
    }

    /**
     * @method setUser function
     *
     * @param UsersEntity|null $user
     * @return void
     */
    public function setUser(UsersEntity $user)
    {
        if (!empty($user))
            $this->attributes['user'] = $user;
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
            $this->dates['created_at'] = $createdAt;
    }

    /**
     * @method mixed getCreatedAt()
     *
     * @return String|null
     */
    public function getCreatedAt(): ?String
    {
        return $this->dates['created_at'];
    }

    /**
     * @method mixed setUpdatedAt()
     *
     * @param String|null $updatedAt
     * @return void
     */
    public function setUpdatedAt(?String $updatedAt)
    {
        if (!empty($updatedAt))
            $this->dates['updated_at'] = $updatedAt;
    }

    /**
     * @method mixed getUpdatedAt()
     *
     * @return String|null
     */
    public function getUpdatedAt(): ?String
    {
        return $this->dates['updated_at'];
    }
}
