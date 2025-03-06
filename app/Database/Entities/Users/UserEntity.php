<?php

namespace App\Database\Entities\Users;

use App\Libraries\Crypto\Crypto;
use CodeIgniter\Entity\Entity;
use Exception;

class UserEntity extends Entity
{
    private string $userKey;
    private Crypto $cryptoLibrary;

    protected $dates = [
        "created_at"       => null,
        "updated_at"       => null,
        "deleted_at"       => null
    ];
    public $attributes = [
        'id'               => null,
        'name'             => null,
        'login'            => null,
        'password'         => null,
        'photo'            => null,
        'cpf'              => null,
        'birthdate'        => null,
        'rg'               => null,
        'registration'     => null,
        'status'           => null,
        'keyword'          => null,
        'is_social'        => null,
        'system_key'       => null,
        'twof_secret_enc'  => null,
        'groups'           => null
    ];

    public function __construct(String $systemKey)
    {
        $this->cryptoLibrary = new Crypto();

        if (!empty($systemKey))
            $this->userKey = $this->cryptoLibrary->decrypt($systemKey, (getenv('system.encrypted_key')));
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
        $session = session();
        $LANGUAGE = $session->get("language");
        $NAME_TRANSLATE = lang('Words.name', [], $LANGUAGE);

        if (strlen($name) > 100)
            throw new Exception(lang('Validation.max_length', [
                "field" => $NAME_TRANSLATE,
                "param" => 100
            ],  $LANGUAGE), BAD_REQUEST);

        if (!empty($name))
            $this->attributes['name'] = $name;
    }

    /**
     * @method mixed setLogin()
     *
     * @param String|null $login
     * @return void
     */
    public function setLogin(?String $login)
    {
        $session = session();

        if (preg_match(VALIDATE_EMAIL, $login) === false)
            throw new Exception(lang('Validation.invalid_email', [], $session->get("language")), BAD_REQUEST);

        if (!empty($login))
            $this->attributes['login'] = $this->cryptoLibrary->encrypt(strtolower($login), $this->userKey);
    }

    /**
     * @method mixed getLogin()
     *
     * @return String|null
     */
    public function getLogin(): ?String
    {
        return $this->cryptoLibrary->decrypt($this->attributes['login'], $this->userKey);
    }

    /**
     * @method mixed setPassword()
     *
     * @param String|null $password
     * @return void
     */
    public function setPassword(?string $password)
    {
        $session = session();
        $LANGUAGE = $session->get("language");
        $PASSWORD_TRANSLATE = lang('Words.password', [], $LANGUAGE);

        if (strlen($password) > 20)
            throw new Exception(lang('Validation.max_length', [
                "field" => $PASSWORD_TRANSLATE,
                "param" => 20
            ], $LANGUAGE), BAD_REQUEST);

        if (!empty($password))
            $this->attributes['password'] = $this->cryptoLibrary->encrypt($password, $this->userKey);
    }

    /**
     * @method mixed getPassword()
     *
     * @return String|null
     */
    public function getPassword(): string
    {
        return $this->cryptoLibrary->decrypt($this->attributes['password'], $this->userKey);
    }

    /**
     * @method String setPhoto()
     *
     * @param integer $photo
     * @return void
     */
    public function setPhoto(?String $photo)
    {
        if (!empty($photo))
            $this->attributes['photo'] = $photo;
    }

    /**
     * @method String getPhoto()
     *
     * @return String|null
     */
    public function getPhoto(): ?String
    {
        return  $this->attributes['photo'];
    }

    /**
     * @method mixed setCpf()
     *
     * @param string|null $cpf O valor bruto do CPF sem pontuação "18222234798"
     * @return void
     */
    public function setCpf(?string $cpf)
    {
        $session = session();
        $cpf = str_replace([".", "-"], "", $cpf);

        if (strlen($cpf) > 11)
            throw new Exception(lang('Validation.max_length', [
                "field" => "Cpf",
                "param" => 11
            ], $session->get("language")), BAD_REQUEST);

        if (!empty($cpf))
            $this->attributes['cpf'] = $this->cryptoLibrary->encrypt($cpf, $this->userKey);
    }

    /**
     * @method mixed getCpf()
     *
     * @return String|null
     */
    public function getCpf(): ?String
    {
        return $this->cryptoLibrary->decrypt($this->attributes['cpf'], $this->userKey);
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
     * @method mixed setRg()
     *
     * @param String|null $rg
     * @return void
     */
    public function setRg(?String $rg)
    {
        $session = session();

        if (strlen($rg) > 30)
            throw new Exception(lang('Validation.max_length', [
                "field" => "RG",
                "param" => 30
            ], $session->get("language")), BAD_REQUEST);

        if (!empty($rg))
            $this->attributes['rg'] = $this->cryptoLibrary->encrypt($rg, $this->userKey);
    }

    /**
     * @method mixed getRg()
     *
     * @return String|null
     */
    public function getRg(): ?String
    {
        return $this->cryptoLibrary->decrypt($this->attributes['rg'], $this->userKey);
    }

    /**
     * @method mixed setRegistration()
     *
     * @param String|null $registration
     * @return void
     */
    public function setRegistration(?String $registration)
    {
        $session = session();

        if (strlen($registration) > 30)
            throw new Exception(lang('Validation.max_length', [
                "field" => "RG",
                "param" => 30
            ], $session->get("language")), BAD_REQUEST);

        if (!empty($registration))
            $this->attributes['registration'] = $this->cryptoLibrary->encrypt($registration, $this->userKey);
    }

    /**
     * @method mixed getRegistration()
     *
     * @return String|null
     */
    public function getRegistration(): ?String
    {
        return $this->cryptoLibrary->decrypt($this->attributes['registration'], $this->userKey);
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
        $session = session();

        if (array_search($status, ["ACTIVE", "INACTIVE", "ANALYSIS"]) === false)
            throw new Exception(lang('Validation.enum_invalid', [], $session->get("language")), BAD_REQUEST);

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
        $session = session();
        $LANGUAGE = $session->get("language");
        $KEYWORD_TRANSLATE = lang('Words.keyword', [], $LANGUAGE);

        if (strlen($keyword) > 100)
            throw new Exception(lang('Validation.max_length', [
                "field" => $KEYWORD_TRANSLATE,
                "param" => 100
            ], $LANGUAGE), BAD_REQUEST);

        if (!empty($keyword))
            $this->attributes['keyword'] = $this->cryptoLibrary->encrypt($keyword, $this->userKey);
    }

    /**
     * @method mixed getKeyword()
     *
     * @return String|null
     */
    public function getKeyword(): ?String
    {
        return $this->cryptoLibrary->decrypt($this->attributes['keyword'], $this->userKey);
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
     * @method mixed setTwofSecretEnc()
     *
     * @param String|null $twofSecretEnc
     * @return void
     */
    public function setTwofSecretEnc(?String $twofSecretEnc)
    {
        $session = session();

        if (strlen($twofSecretEnc ?? "") > 250)
            throw new Exception(lang('Validation.max_length', [
                "field" => "twof_secret_enc",
                "param" => 250
            ], $session->get("language")), BAD_REQUEST);

        if (!empty($twofSecretEnc))
            $this->attributes['twof_secret_enc'] = $twofSecretEnc;
    }

    /**
     * @method mixed getTwofSecretEnc()
     *
     * @return String|null
     */
    public function getTwofSecretEnc(): ?String
    {
        return $this->attributes['twof_secret_enc'];
    }

    /**
     * @method mixed setIsSocial()
     *
     * @param String|null $isSocial
     * @return void
     */
    public function setIsSocial(?bool $isSocial)
    {
        $session = session();

        if (gettype($isSocial) != 'boolean')
            throw new Exception(lang('Validation.invalid_field', ["field" => "is_social"], $session->get("language")), BAD_REQUEST);

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
        $session = session();

        if (strlen($systemKey) > 400)
            throw new Exception(lang('Validation.max_length', [
                "field" => "system_key",
                "param" => 400
            ], $session->get("language")), BAD_REQUEST);

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
            $this->attributes['groups'] = $groups;
    }

    /**
     * @method mixed getGroups()
     *
     * @return array<GroupsEntity>|null
     */
    public function getGroups(): array|null
    {
        return $this->attributes['groups'];
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

    /**
     * @method mixed setDeletedAt()
     *
     * @param String|null $deletedAt
     * @return void
     */
    public function setDeletedAt(?String $deletedAt)
    {
        if (!empty($deletedAt))
            $this->dates['deleted_at'] = $deletedAt;
    }

    /**
     * @method mixed getDeletedAt()
     *
     * @return String|null
     */
    public function getDeletedAt(): ?String
    {
        return $this->dates['deleted_at'];
    }
}
