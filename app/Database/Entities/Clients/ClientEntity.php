<?php

namespace App\Database\Entities\Clients;

use App\Libraries\Crypto\Crypto;
use App\Traits\CryptoEntityTrait;
use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;
use Exception;

class ClientEntity extends Entity
{
    use CryptoEntityTrait, EntityEnhancerTrait;

    public $attributes = [
        'id'              => null,
        'name'            => null,
        'avatar'          => null,
        'phone'           => null,
        'email'           => null,
        'birthdate'       => null,
        'status'          => null,
        'phone_sha1'      => null,
        'system_key'      => null,
        'owner_id'        => null,
        'created_at'      => null,
        'updated_at'      => null
    ];

    public function __construct()
    {
        $this->cryptoLibrary = new Crypto();
    }

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
     * @method mixed getName()
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->attributes['name'];
    }

    /**
     * @method mixed setName()
     *
     * @param string|null $name
     * @return void
     */
    public function setName(?string $name)
    {
        $NAME_TRANSLATE = lang('Words.name');

        if (!empty($name) && strlen($name) > 100)
            throw new Exception(lang('Validation.max_length', [
                "field" => $NAME_TRANSLATE,
                "param" => 100
            ]), BAD_BUSINESS_RULES);

        if (!empty($name)) {
            $this->attributes['name'] = $name;
        }
    }

    /**
     * @method mixed getAvatar()
     *
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->attributes['avatar'];
    }

    /**
     * @method mixed setAvatar()
     *
     * @param string|null $avatar
     * @return void
     */
    public function setAvatar(?string $avatar)
    {;

        if (!empty($avatar) && !strlen($avatar) > 500)
            throw new Exception(lang('Validation.max_length', [
                "field" => "avatar",
                "param" => 500
            ]), BAD_BUSINESS_RULES);

        if (!empty($avatar)) {
            $this->attributes['avatar'] = $avatar;
        }
    }

    /**
     * @method mixed getPhone()
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->attributes['phone'];
    }

    /**
     * @method mixed getDecryptPhone()
     *
     * @return String|null
     */
    public function getDecryptPhone()
    {
        return $this->cryptoLibrary->decrypt($this->attributes['phone'], $this->getEncryptedKey());
    }

    /**
     * @method mixed setPhone()
     *
     * @param string|null $phone
     * @return void
     */
    public function setPhone(?string $phone)
    {
        $PHONE_TRANSLATE = lang('Words.phone');

        if (!empty($phone) && strlen($phone) > 255)
            throw new Exception(lang('Validation.max_length', [
                "field" => $PHONE_TRANSLATE,
                "param" => 255
            ]), BAD_BUSINESS_RULES);

        if (!empty($phone)) {
            $this->attributes['phone'] = $phone;
        }
    }

    /**
     * @method mixed setEncryptPhone()
     *
     * @param String|null $phone
     * @return void
     */
    public function setEncryptPhone(?String $phone)
    {
        if (!empty($phone))
            $this->attributes['phone'] = $this->cryptoLibrary->encrypt(str_replace(['-', ' ', '(', ')'], '', $phone), $this->getEncryptedKey());
    }

    /**
     * @method mixed getEmail()
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->attributes['email'];
    }

    /**
     * @method mixed getDecryptEmail()
     *
     * @return String|null
     */
    public function getDecryptEmail()
    {
        return $this->cryptoLibrary->decrypt($this->attributes['email'], $this->getEncryptedKey());
    }

    /**
     * @method mixed setEmail()
     *
     * @param string|null $email
     * @return void
     */
    public function setEmail(?string $email)
    {
        $EMAIL_TRANSLATE = lang('Words.email');

        if (!empty($email) && strlen($email) > 255)
            throw new Exception(lang('Validation.max_length', [
                "field" => $EMAIL_TRANSLATE,
                "param" => 255
            ]), BAD_BUSINESS_RULES);

        if (!empty($email)) {
            $this->attributes['email'] = $email;
        }
    }

    /**
     * @method mixed setEncryptEmail()
     *
     * @param String|null $email
     * @return void
     */
    public function setEncryptEmail(?String $email)
    {
        if (!empty($email))
            $this->attributes['email'] = $this->cryptoLibrary->encrypt(strtolower($email), $this->getEncryptedKey());
    }


    /**
     * @method mixed getBirthdate()
     *
     * @return string|null
     */
    public function getBirthdate(): ?string
    {
        return $this->attributes['birthdate'];
    }

    /**
     * @method mixed setBirthdate()
     *
     * @param string|null $birthdate
     * @return void
     */
    public function setBirthdate(?string $birthdate)
    {
        if (!empty($birthdate)) {
            $this->attributes['birthdate'] = $birthdate;
        }
    }

    /**
     * @method mixed getStatus()
     *
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->attributes['status'];
    }

    /**
     * @method mixed setStatus()
     *
     * @param string|null $status
     * @return void
     */
    public function setStatus(?string $status)
    {
        if (!empty($status)) {
            $this->attributes['status'] = $status;
        }
    }

    /**
     * @method mixed getPhoneSha1()
     *
     * @return string|null
     */
    public function getPhoneSha1(): ?string
    {
        return $this->attributes['phone_sha1'];
    }

    /**
     * @method mixed setPhoneSha1()
     *
     * @param string|null $phoneSha1
     * @return void
     */
    public function setPhoneSha1(?string $phoneSha1)
    {
        if (!empty($phoneSha1)) {
            $this->attributes['phone_sha1'] = $phoneSha1;
        }
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
     * @method mixed getSystemKey()
     *
     * @return string|null
     */
    public function getSystemKey(): ?string
    {
        return $this->attributes['system_key'];
    }

    /**
     * @method mixed setSystemKey()
     *
     * @param string|null $systemKey
     * @return void
     */
    public function setSystemKey(?string $systemKey)
    {
        if (!empty($systemKey)) {
            $this->attributes['system_key'] = $systemKey;
        }
    }

    /**
     * @method mixed getCreatedAt()
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    /**
     * @method mixed setCreatedAt()
     *
     * @param string|null $createdAt
     * @return void
     */
    public function setCreatedAt(?string $createdAt)
    {
        if (!empty($createdAt)) {
            $this->attributes['created_at'] = $createdAt;
        }
    }

    /**
     * @method mixed getUpdatedAt()
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }

    /**
     * @method mixed setUpdatedAt()
     *
     * @param string|null $updatedAt
     * @return void
     */
    public function setUpdatedAt(?string $updatedAt)
    {
        if (!empty($updatedAt)) {
            $this->attributes['updated_at'] = $updatedAt;
        }
    }
}
