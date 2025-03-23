<?php

namespace App\Database\Entities\Users;

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
        'cpf'              => null,
        'birthdate'        => null,
        'status'           => null,
        'keyword'          => null,
        'email_sha1'       => null,
        'phone_sha1'       => null,
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
    public function setName(?String $name)
    {
        $NAME_TRANSLATE = lang('Words.name');

        if (strlen($name) > 100)
            throw new Exception(lang('Validation.max_length', [
                "field" => $NAME_TRANSLATE,
                "param" => 100
            ]), BAD_BUSINESS_RULES);

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
            throw new Exception(lang('Validation.invalid_email'), BAD_REQUEST);

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
        $PASSWORD_TRANSLATE = lang('Words.password');

        if (strlen($password) > 20)
            throw new Exception(lang('Validation.max_length', [
                "field" => $PASSWORD_TRANSLATE,
                "param" => 20
            ]), BAD_REQUEST);

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
     * @method mixed setCpf()
     *
     * @param string|null $cpf O valor bruto do CPF sem pontuação "18222234798"
     * @return void
     */
    public function setCpf(?string $cpf)
    {
        if (!empty($cpf))
            $this->attributes['cpf'] = $cpf;
    }

    /**
     * @method mixed setEncryptCpf()
     *
     * @param string|null $cpf O valor bruto do CPF sem pontuação "18222234798"
     * @return void
     */
    public function setEncryptCpf(?string $cpf)
    {
        $cpf = str_replace([".", "-"], "", $cpf);

        if (strlen($cpf) > 11)
            throw new Exception(lang('Validation.max_length', [
                "field" => "Cpf",
                "param" => 11
            ]), BAD_REQUEST);

        if (!empty($cpf))
            $this->attributes['cpf'] = $this->cryptoLibrary->encrypt($cpf, $this->getEncryptedKey());;
    }

    /**
     * @method mixed getCpf()
     *
     * @return String|null
     */
    public function getCpf()
    {
        return $this->attributes['cpf'];
    }

    /**
     * @method mixed getDecryptCpf()
     *
     * @return String|null
     */
    public function getDecryptCpf()
    {
        return $this->cryptoLibrary->decrypt($this->attributes['cpf'], $this->getEncryptedKey());
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
            throw new Exception(lang('Validation.max_length', [
                "field" => "phone",
                "param" => 20
            ]), BAD_BUSINESS_RULES);

        if (!empty($phone))
            $this->attributes['phone'] = $this->cryptoLibrary->encrypt($phone, $this->getEncryptedKey());
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
            throw new Exception(lang('Validation.enum_invalid'), BAD_REQUEST);

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
        $KEYWORD_TRANSLATE = lang('Words.keyword');

        if (strlen($keyword) > 100)
            throw new Exception(lang('Validation.max_length', [
                "field" => $KEYWORD_TRANSLATE,
                "param" => 100
            ]), BAD_REQUEST);

        if (!empty($keyword))
            $this->attributes['keyword'] = $this->cryptoLibrary->encrypt($keyword, $this->getEncryptedKey());
        else  $this->attributes['keyword'] = $keyword;
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
     * @method mixed setEmailSha1()
     *
     * @param string|null $emailSha1
     * @return void
     */
    public function setEmailSha1(?string $emailSha1)
    {
        if (!empty($emailSha1))
            $this->attributes['email_sha1'] = $emailSha1;
    }

    /**
     * @method mixed getEmailSha1()
     *
     * @return String|null
     */
    public function getEmailSha1(): ?String
    {
        return $this->attributes['email_sha1'];
    }

    /**
     * @method mixed setPhoneSha1()
     *
     * @param string|null $phone_sha1
     * @return void
     */
    public function setPhoneSha1(?string $phone_sha1)
    {
        if (!empty($phone_sha1))
            $this->attributes['phone_sha1'] = $phone_sha1;
    }

    /**
     * @method mixed getPhoneSha1()
     *
     * @return String|null
     */
    public function getPhoneSha1(): ?String
    {
        return $this->attributes['phone_sha1'];
    }

    /**
     * @method mixed setCPFSha1()
     *
     * @param string|null $cpf_sha1
     * @return void
     */
    public function setCPFSha1(?string $cpf_sha1)
    {
        if (!empty($cpf_sha1))
            $this->attributes['cpf_sha1'] = $cpf_sha1;
    }

    /**
     * @method mixed getCPFSha1()
     *
     * @return String|null
     */
    public function getCPFSha1(): ?String
    {
        return $this->attributes['cpf_sha1'];
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
            throw new Exception(lang('Validation.max_length', [
                "field" => "twof_secret",
                "param" => 250
            ]), BAD_REQUEST);

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
            throw new Exception(lang('Validation.invalid_field', ["field" => "is_social"]), BAD_REQUEST);

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

        if (strlen($systemKey) > 400)
            throw new Exception(lang('Validation.max_length', [
                "field" => "system_key",
                "param" => 400
            ]), BAD_REQUEST);

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
