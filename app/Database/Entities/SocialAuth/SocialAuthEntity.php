<?php

namespace App\Database\Entities\SocialAuth;

use CodeIgniter\Entity\Entity;
use Exception;

class SocialAuthEntity extends Entity
{
    protected $dates = [
        "created_at"      => null,
        "updated_at"      => null
    ];
    public $attributes = [
        'id'              => null,
        'type'            => null,
        'external_id'     => null,
        'email'           => null,
        'configs'         => null,
        'user_id'         => null
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
     * getType function
     *
     * @return String|null
     */
    public function getType(): ?String
    {
        return $this->attributes['type'];
    }

    /**
     * setType function
     *
     * @param String|null $type
     * @return void
     */
    public function setType(?String $type)
    {
        $session = session();

        if (!empty($type) && array_search($type, ['GOOGLE', 'FACEBOOK']) === false)
            throw new Exception(lang('Validation.enum_invalid', ["field" => "type"], $session->get("language")), BAD_REQUEST);

        if (!empty($type))
            $this->attributes['type'] = $type;
    }

    /**
     * getExternalId function
     *
     * @return String|null
     */
    public function getExternalId(): ?String
    {
        return $this->attributes['external_id'];
    }

    /**
     * setExternalId function
     *
     * @param String|null $externalId
     * @return void
     */
    public function setExternalId(?String $externalId)
    {
        $session = session();

        if (!empty($email) && strlen($externalId) > 150)
            throw new Exception(lang('Validation.max_length', [
                "field" => "External_id",
                "param" => 150
            ], $session->get("language")), INTERNAL_ERROR);

        if (!empty($externalId))
            $this->attributes['external_id'] = $externalId;
    }

    /**
     * @method mixed setEmail()
     *
     * @param String|null $email
     * @return void
     */
    public function setEmail(?String $email)
    {
        $session = session();

        if (!empty($email) && preg_match(VALIDATE_EMAIL, $email) === false)
            throw new Exception(lang('Validation.invalid_email', [], $session->get("language")), BAD_REQUEST);

        if (!empty($email))
            $this->attributes['email'] = strtolower($email);
    }

    /**
     * @method mixed getEmail()
     *
     * @return String|null
     */
    public function getEmail(): ?String
    {
        return $this->attributes['email'];
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
