<?php

namespace App\Database\Entities\Users;

use App\Libraries\Exceptions\Exceptions;
use App\Traits\CryptoEntityTrait;
use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;
use Exception;

class UserEntity extends Entity
{
    use EntityEnhancerTrait, CryptoEntityTrait;

    public $attributes = [
        'id'               => null,
        'name'             => null,
        'email'            => null,
        'password'         => null,
        'phone'            => null,
        'avatar'           => null,
        'document'         => null,
        'document_type'    => null,
        'birthdate'        => null,
        'status'           => null,
        'keyword'          => null,
        'email_sha256'     => null,
        'phone_sha256'     => null,
        'document_sha256'  => null,
        'system_key'       => null,
        'twof_secret'      => null,
        "created_at"       => null,
        "updated_at"       => null,
        "deleted_at"       => null
    ];
    public $relations = [
        'groups'           => null
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
     * @method mixed getName()
     *
     * @return String|null
     */
    public function getName(): ?String
    {
        return $this->attributes['name'];
    }

    /**
     * @method mixed setName()
     *
     * @param String|null $name
     * @return void
     */
    public function setName(?String $name = "")
    {

        if (strlen($name) > 100)
            throw new Exception("Api.users.invalid.name_max_length_100", BAD_BUSINESS_RULES);

        if (!empty($name))
            $this->attributes['name'] = $name;
    }

    /**
     * @method mixed setEmail()
     *
     * @param String|null $email
     * @return void
     */
    public function setEmail(?String $email)
    {

        if (!empty($email))
            $this->attributes['email'] = $email;
    }

    /**
     * @method mixed setEncryptEmail()
     *
     * @param String|null $email
     * @return void
     */
    public function setEncryptEmail(?String $email)
    {

        if (preg_match(VALIDATE_EMAIL, $email) === false)
            throw new Exceptions("Api.users.invalid.email", BAD_REQUEST);

        if (!empty($email))
            $this->attributes['email'] = $this->cryptoLibrary->encrypt(strtolower($email), $this->getEncryptedKey());
    }

    /**
     * @method mixed getEmail()
     *
     * @return String|null
     */
    public function getEmail()
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
     * @method mixed setPassword()
     *
     * @param String|null $password
     * @return void
     */
    public function setPassword(?string $password)
    {

        if (!empty($password))
            $this->attributes['password'] = $password;
    }

    /**
     * @method mixed setEncryptPassword()
     *
     * @param String|null $password
     * @return void
     */
    public function setEncryptPassword(?string $password)
    {
        if (strlen($password) > 20)
            throw new Exception("Api.users.invalid.password_max_length_20", BAD_REQUEST);

        if (!empty($password))
            $this->attributes['password'] = $this->cryptoLibrary->encrypt($password, $this->getEncryptedKey());
    }

    /**
     * @method mixed getPassword()
     *
     * @return String|null
     */
    public function getPassword()
    {
        return $this->attributes['password'];
    }

    /**
     * @method mixed getDecryptPassword()
     *
     * @return String|null
     */
    public function getDecryptPassword()
    {
        return $this->cryptoLibrary->decrypt($this->attributes['password'], $this->getEncryptedKey());
    }

    /**
     * @method String setAvatar()
     *
     * @param integer $avatar
     * @return void
     */
    public function setAvatar(?String $avatar)
    {
        if (!empty($avatar))
            $this->attributes['avatar'] = $avatar;
    }

    /**
     * @method String getAvatar()
     *
     * @return String|null
     */
    public function getAvatar(): ?String
    {
        return  $this->attributes['avatar'];
    }

    /**
     * @method mixed setDocument()
     *
     * @param string|null $document O valor bruto do documento sem pontuação "18222234798"
     * @return void
     */
    public function setDocument(?string $document)
    {
        if (!empty($document))
            $this->attributes['document'] = $document;
    }

    /**
     * @method mixed setDocumentType()
     *
     * @param string|null $typeDocument O tipo de documentação
     * @return void
     */
    public function setDocumentType(?string $typeDocument)
    {
        if (!empty($typeDocument))
            $this->attributes['document_type'] = $typeDocument;
    }

    /**
     * @method mixed setEncryptDocument()
     *
     * @param string|null $document O valor bruto do documento sem pontuação "18222234798"
     * @return void
     */
    public function setEncryptDocument(?string $document)
    {
        if (!empty($document))
            $this->attributes['document'] = $this->cryptoLibrary->encrypt($document, $this->getEncryptedKey());;
    }

    /**
     * @method mixed getDocument()
     *
     * @return String|null
     */
    public function getDocument()
    {
        return $this->attributes['document'];
    }

    /**
     * @method mixed getDocumentType()
     *
     * @return String|null
     */
    public function getDocumentType()
    {
        return $this->attributes['document_type'];
    }

    /**
     * @method mixed getDecryptDocument()
     *
     * @return String|null
     */
    public function getDecryptDocument()
    {
        return $this->cryptoLibrary->decrypt($this->attributes['document'], $this->getEncryptedKey());
    }

    /**
     * @method mixed setPhone()
     *
     * @param string|null $phone O valor do telefone
     * @return void
     */
    public function setPhone(?string $phone)
    {

        if (!empty($phone))
            $this->attributes['phone'] = $phone;
    }

    /**
     * @method mixed setEncryptPhone()
     *
     * @param string|null $phone O valor do Telefone
     * @return void
     */
    public function setEncryptPhone(?string $phone)
    {
        if (strlen($phone) > 20)
            throw new Exception("Api.users.invalid.phone", BAD_BUSINESS_RULES);

        if (!empty($phone))
            $this->attributes['phone'] = $this->cryptoLibrary->encrypt(str_replace(['-', ' ', '(', ')'], '', $phone), $this->getEncryptedKey());
    }

    /**
     * @method mixed getPhone()
     *
     * @return String|null
     */
    public function getPhone()
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
     * @method mixed setBirthdate()
     *
     * @param String|null $birthdate
     * @return void
     */
    public function setBirthdate(?String $birthdate)
    {
        if (empty($birthdate)) return;

        if (count(explode("/", $birthdate)) >= 3)
            $this->attributes['birthdate'] = date("Y-m-d", strtotime(str_replace("/", "-", $birthdate)));
        else  $this->attributes['birthdate'] = $birthdate;
    }

    /**
     * @method mixed getBirthdate()
     *
     * @return String|null
     */
    public function getBirthdate(): ?String
    {
        return  $this->attributes['birthdate'];
    }

    /**
     * @method mixed getStatus()
     *
     * @return ACTIVE|INACTIVE|ANALYSIS
     */
    public function getStatus(): ?String
    {
        return $this->attributes['status'];
    }

    /**
     * @method mixed setStatus()
     *
     * @param ACTIVE|INACTIVE|ANALYSIS|null $status
     * @return void
     */
    public function setStatus(?String $status)
    {

        if (array_search($status, ["ACTIVE", "INACTIVE", "ANALYSIS"]) === false)
            throw new Exception("Api.users.invalid.status", BAD_REQUEST);

        if (!empty($status))
            $this->attributes['status'] = $status;
    }

    /**
     * @method mixed setKeyword()
     *
     * @param string|null $keyword
     * @return void
     */
    public function setKeyword(?string $keyword)
    {
        if (!empty($keyword))
            $this->attributes['keyword'] = $keyword;
    }

    /**
     * @method mixed setEncryptKeyword()
     *
     * @param string|null $keyword
     * @return void
     */
    public function setEncryptKeyword(?string $keyword)
    {
        if (strlen($keyword) > 100)
            throw new Exception("Api.users.invalid.keyword", BAD_REQUEST);

        if (!empty($keyword))
            $this->attributes['keyword'] = $this->cryptoLibrary->encrypt($keyword, $this->getEncryptedKey());
    }

    /**
     * @method mixed getKeyword()
     *
     * @return String|null
     */
    public function getKeyword()
    {
        return $this->attributes['keyword'];
    }

    /**
     * @method mixed getDecryptKeyword()
     *
     * @return String|null
     */
    public function getDecryptKeyword()
    {
        return $this->cryptoLibrary->decrypt($this->attributes['keyword'], $this->getEncryptedKey());
    }


    /**
     * @method mixed setEmailSha256()
     *
     * @param string|null $emailSha256
     * @return void
     */
    public function setEmailSha256(?string $emailSha256)
    {
        if (!empty($emailSha256))
            $this->attributes['email_sha256'] = $emailSha256;
    }

    /**
     * @method mixed getEmailSha256()
     *
     * @return String|null
     */
    public function getEmailSha256(): ?String
    {
        return $this->attributes['email_sha256'];
    }

    /**
     * @method mixed setPhoneSha256()
     *
     * @param string|null $phone_sha256
     * @return void
     */
    public function setPhoneSha256(?string $phone_sha256)
    {
        if (!empty($phone_sha256))
            $this->attributes['phone_sha256'] = $phone_sha256;
    }

    /**
     * @method mixed getPhoneSha256()
     *
     * @return String|null
     */
    public function getPhoneSha256(): ?String
    {
        return $this->attributes['phone_sha256'];
    }

    /**
     * @method mixed setDocumentSha256()
     *
     * @param string|null $document_sha256
     * @return void
     */
    public function setDocumentSha256(?string $document_sha256)
    {
        if (!empty($document_sha256))
            $this->attributes['document_sha256'] = $document_sha256;
    }

    /**
     * @method mixed getDocumentSha256()
     *
     * @return String|null
     */
    public function getDocumentSha256(): ?String
    {
        return $this->attributes['document_sha256'];
    }


    /**
     * @method mixed setTwofSecretEnc()
     *
     * @param String|null $twofSecretEnc
     * @return void
     */
    public function setTwofSecretEnc(?String $twofSecretEnc)
    {

        if (strlen($twofSecretEnc ?? "") > 250)
            throw new Exceptions("Api.users.invalid.twof_secret", BAD_REQUEST);

        if (!empty($twofSecretEnc))
            $this->attributes['twof_secret'] = $twofSecretEnc;
    }

    /**
     * @method mixed getTwofSecretEnc()
     *
     * @return String|null
     */
    public function getTwofSecretEnc(): ?String
    {
        return $this->attributes['twof_secret'];
    }

    /**
     * @method mixed setIsSocial()
     *
     * @param String|null $isSocial
     * @return void
     */
    public function setIsSocial(?bool $isSocial)
    {

        if (gettype($isSocial) != 'boolean')
            throw new Exception("Api.users.invalid.is_social", BAD_REQUEST);

        if (!empty($isSocial))
            $this->attributes['is_social'] = $isSocial;
    }

    /**
     * @method mixed getIsSocial()
     *
     * @return String|null
     */
    public function getIsSocial(): ?String
    {
        return $this->attributes['is_social'];
    }

    /**
     * @method mixed setSystemKey()
     *
     * @param String|null $systemKey
     * @return void
     */
    public function setSystemKey(?String $systemKey)
    {

        if (!empty($systemKey))
            $this->attributes['system_key'] = $systemKey;
    }

    /**
     * @method mixed getSystemKey()
     *
     * @return String|null
     */
    public function getSystemKey(): ?String
    {
        return $this->attributes['system_key'];
    }

    /**
     * @method mixed setGroups()
     *
     * @param array<GroupsEntity>|null $grou´p
     * @return void
     */
    public function setGroups(array|null $groups)
    {
        if (!empty($groups))
            $this->relations['groups'] = $groups;
    }

    /**
     * @method mixed getGroups()
     *
     * @return array<GroupsEntity>|null
     */
    public function getGroups(): array|null
    {
        return $this->relations['groups'];
    }

    /**
     * @method mixed setCreatedAt()
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
     * @method mixed getCreatedAt()
     *
     * @return String|null
     */
    public function getCreatedAt(): ?String
    {
        return $this->attributes['created_at'];
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
            $this->attributes['updated_at'] = $updatedAt;
    }

    /**
     * @method mixed getUpdatedAt()
     *
     * @return String|null
     */
    public function getUpdatedAt(): ?String
    {
        return $this->attributes['updated_at'];
    }

    /**
     * @method mixed setDeletedAt()
     *
     * @param String|null $deletedAt
     * @return void
     */
    public function setDeletedAt(?String $deletedAt)
    {
        if (!empty($deletedAt))
            $this->attributes['deleted_at'] = $deletedAt;
    }

    /**
     * @method mixed getDeletedAt()
     *
     * @return String|null
     */
    public function getDeletedAt(): ?String
    {
        return $this->attributes['deleted_at'];
    }
}
