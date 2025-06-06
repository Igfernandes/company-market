<?php

namespace App\Database\Entities\Invites;

use CodeIgniter\Entity\Entity;
use Exception;

class InviteEntity extends Entity
{

    public $attributes = [
        'id'              => null,
        'token'           => null,
        'type'            => null,
        'data'            => null,
        'is_valid'        => null,
        'owner_id'        => null,
        'expired_at'      => null,
        "created_at"      => null,
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
     * getToken function
     *
     * @return string|null
     */
    public function getToken(): ?String
    {
        return $this->attributes['token'];
    }

    /**
     * setToken function
     *
     * @param string $token
     * @return void
     */
    public function setToken(String $token)
    {
        if (!empty($token))
            $this->attributes['token'] = $token;
    }


    /**
     * getType function
     *
     * @return USER|COMPANY
     */
    public function getType(): ?String
    {
        return $this->attributes['type'];
    }

    /**
     * setType function
     *
     * @param USER|COMPANY $type
     * @return void
     */
    public function setType(?String $type)
    {
        if (!empty($type))
            $this->attributes['type'] = $type;
    }

    /**
     * getData function
     *
     * @return String|null
     */
    public function getData(): ?String
    {
        return $this->attributes['data'] ;
    }

    /**
     * setData function
     *
     * @param String|null $data
     * @return void
     */
    public function setData(?String $data)
    {
        if (!empty($data))
            $this->attributes['data'] = $data;
    }


    /**
     * getIsValid function
     *
     * @return Bool|null
     */
    public function getIsValid(): ?bool
    {
        return $this->attributes['is_valid'];
    }

    /**
     * setIsValid function
     *
     * @param Bool|null $isValid
     * @return void
     */
    public function setIsValid(?bool $isValid)
    {
        $session = session();
        $LANGUAGE = $session->get("language");

        if (!is_bool($isValid))
            throw new Exception(lang('Validation.invalid_field', [
                "field" => "is_valid"
            ], $LANGUAGE), INTERNAL_ERROR);

        $this->attributes['is_valid'] = $isValid;
    }

    /**
     * @method mixed getOwnerId()
     *
     * @return int|null
     */
    public function getOwnerId(): ?int
    {
        return $this->attributes['owner_id'];
    }

    /**
     * @method mixed setOwnerId()
     *
     * @param int|null $ownerId
     * @return void
     */
    public function setOwnerId(?int $ownerId)
    {
        if (!empty($ownerId)) {
            $this->attributes['owner_id'] = $ownerId;
        }
    }

    /**
     * setExpiredAt function
     *
     * @param String|null $createdAt
     * @return void
     */
    public function setExpiredAt(?String $expiredAt)
    {
        if (!empty($expiredAt))
            $this->attributes['expired_at'] = $expiredAt;
    }

    /**
     * getExpiredAt function
     *
     * @return String|null
     */
    public function getExpiredAt(): ?String
    {
        return $this->attributes['expired_at'];
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
