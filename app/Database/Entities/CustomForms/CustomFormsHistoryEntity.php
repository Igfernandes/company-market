<?php

namespace App\Database\Entities\CustomForms;

use App\Database\Entities\Users\UserEntity;
use App\Database\Entities\Users\UsersEntity;
use CodeIgniter\Entity\Entity;
use Exception;

class CustomFormsHistoryEntity extends Entity
{
    protected $dates = [
        "created_at"      => null
    ];
    public $attributes = [
        'id'              => null,
        'description'            => null,
        'form_id'         => null,
        'form'            => null,
        'user_id'         => null,
        'user'            => null
    ];

    /**
     * getId function
     *
     * @return Int|null
     */
    public function getId(): ?Int
    {
        return $this->attributes['id'];
    }

    /**
     * setId function
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
     * getDescription function
     *
     * @return String|null
     */
    public function getDescription(): ?String
    {
        return $this->attributes['description'];
    }

    /**
     * setDescription function
     *
     * @param String|null $description
     * @return void
     */
    public function setDescription(?String $description)
    {
        $session = session();
        $LANGUAGE = $session->get("language");
        $KIN_NAME_TRANSLATE = lang('Words.description', [], $LANGUAGE);

        if (strlen($description) > 150)
            throw new Exception(lang('Validation.max_length', [
                "field" => $KIN_NAME_TRANSLATE,
                "param" => 250
            ], $LANGUAGE), BAD_REQUEST);

        if (!empty($description))
            $this->attributes['description'] = $description;
    }

    /**
     * getFormId function
     *
     * @return Int|null
     */
    public function getFormId(): ?Int
    {
        return $this->attributes['form_id'];
    }

    /**
     * setFormId function
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
     * getForm function
     *
     * @return CustomFormsEntity|null
     */
    public function getForm(): ?CustomFormsEntity
    {
        return $this->attributes['form'];
    }

    /**
     * setForm function
     *
     * @param CustomFormsEntity|null $user
     * @return void
     */
    public function setForm(CustomFormsEntity $form)
    {
        if (!empty($form))
            $this->attributes['form'] = $form;
    }

    /**
     * getUserId function
     *
     * @return Int|null
     */
    public function getUserId(): ?Int
    {
        return $this->attributes['user_id'];
    }

    /**
     * setUserId function
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
     * getUser function
     *
     * @return UsersEntity|null
     */
    public function getUser(): ?UserEntity
    {
        return $this->attributes['user'];
    }

    /**
     * setUser function
     *
     * @param UsersEntity|null $user
     * @return void
     */
    public function setUser(UserEntity $user)
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
     * getCreatedAt function
     *
     * @return String|null
     */
    public function getCreatedAt(): ?String
    {
        return $this->dates['created_at'];
    }
}
