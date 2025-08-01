<?php

namespace App\Database\Entities\SettingsPrivacy;

use CodeIgniter\Entity\Entity;
use Exception;

class SettingPrivacyEntity extends Entity
{
    public $attributes = [
        'id'              => null,
        'name'           => null,
        'created_at'      => null,
        'updated_at'      => null
    ];

    /**
     * @method getId function
     *
     * @return Int|null
     */
    public function getId(): ?Int
    {
        return $this->attributes['id'];
    }

    /**
     * @method setId function
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
     * @method getName function
     *
     * @return String|null
     */
    public function getName(): ?String
    {
        return $this->attributes['name'];
    }

    /**
     * @method setName function
     *
     * @param String|null $name
     * @return void
     */
    public function setName(?String $name)
    {
        if (strlen($name) > 50)
            throw new Exception("Api.settings_privacy.invalid.name_max_length_50", BAD_REQUEST);

        if (!empty($name))
            $this->attributes['name'] = $name;
    }

    /**
     * @method setCreatedAt function
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
     * @method getCreatedAt function
     *
     * @return String|null
     */
    public function getCreatedAt(): ?String
    {
        return $this->dates['created_at'];
    }

    /**
     * @method setUpdatedAt function
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
     * @method getUpdatedAt function
     *
     * @return String|null
     */
    public function getUpdatedAt(): ?String
    {
        return $this->dates['updated_at'];
    }
}
