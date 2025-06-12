<?php

namespace App\Database\Entities\SettingsPrivacy;

use CodeIgniter\Entity\Entity;
use Exception;

class SettingPrivacyEntity extends Entity
{
    protected $dates = [];
    public $attributes = [
        'id'              => null,
        'title'           => null,
        'describes'       => null,
        'path'            => null,
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
     * @method getTitle function
     *
     * @return String|null
     */
    public function getTitle(): ?String
    {
        return $this->attributes['title'];
    }

    /**
     * @method setTitle function
     *
     * @param String|null $title
     * @return void
     */
    public function setTitle(?String $title)
    {
        $session = session();
        $LANGUAGE = $session->get("language");
        $CONFIGURATION_PRIVACY_TRANSLATE = lang('Words.configuration_privacy', [], $LANGUAGE);

        if (strlen($title) > 250)
            throw new Exception(lang('Validation.max_length', [
                "field" => $CONFIGURATION_PRIVACY_TRANSLATE,
                "value" => 250
            ], $LANGUAGE), BAD_REQUEST);

        if (!empty($title))
            $this->attributes['title'] = $title;
    }

    /**
     * @method getDescribes function
     *
     * @return String|null
     */
    public function getDescribes(): ?String
    {
        return $this->attributes['describes'];
    }

    /**
     * @method setDescribes function
     *
     * @param String|null $describe
     * @return void
     */
    public function setDescribes(?String $describe)
    {
        if (!empty($describe))
            $this->attributes['describes'] = $describe;
    }

    /**
     * @method getPath function
     *
     * @return String|null
     */
    public function getPath(): ?String
    {
        return $this->attributes['path'];
    }

    /**
     * @method setPath function
     *
     * @param String|null $path
     * @return void
     */
    public function setPath(?String $path)
    {
        if (!empty($path))
            $this->attributes['path'] = $path;
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
