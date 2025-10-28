<?php

namespace App\Database\Entities\Companies;

use App\Traits\CryptoEntityTrait;
use CodeIgniter\Entity\Entity;
use CodeIgniter\HTTP\Response;
use Exception;

class CompanyEntity extends Entity
{
    use CryptoEntityTrait;

    public $attributes = [
        'id'              => null,
        'name'            => null,
        'logotype'        => null,
        'phone'           => null,
        'email'           => null,
        'inscribed_at'    => null,
        'status'          => null,
        'phone_sha256'    => null,
        'document'        => null,
        'document_type'   => null,
        'system_key'      => null,
        'owner_id'        => null,
        'created_at'      => null,
        'updated_at'      => null,
        'deleted_at'      => null,
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
        if (!empty($name) && strlen($name) > 100)
            throw new Exception('Api.clients.name', Response::HTTP_NOT_ACCEPTABLE);

        if (!empty($name)) {
            $this->attributes['name'] = $name;
        }
    }

    /**
     * @method mixed getLogotype()
     *
     * @return string|null
     */
    public function getLogotype(): ?string
    {
        return $this->attributes['logotype'];
    }

    /**
     * @method mixed setLogotype()
     *
     * @param string|null $logotype
     * @return void
     */
    public function setLogotype(?string $logotype)
    {

        $this->attributes['logotype'] = $logotype;
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
        if (!empty($phone) && strlen($phone) > 35)
            throw new Exception(
                "Api.clients.phone",
                Response::HTTP_NOT_ACCEPTABLE
            );

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
        if (!empty($email) && strlen($email) > 255)
            throw new Exception("Api.clients.email", Response::HTTP_NOT_ACCEPTABLE);

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
        if (!empty($email))
            $this->attributes['email'] = $this->cryptoLibrary->encrypt(strtolower($email), $this->getEncryptedKey());
    }


    /**
     * @method string getInscribedAt()
     *
     * @return string|null
     */
    public function getInscribedAt(): ?string
    {
        return $this->attributes['inscribed_at'];
    }

    /**
     * @method mixed setInscribedAt()
     *
     * @param string|null $inscribedAt
     * @return void
     */
    public function setInscribedAt(?string $inscribedAt)
    {
        if (!empty($inscribedAt)) {
            $this->attributes['inscribed_at'] = $inscribedAt;
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
     * @method mixed getDocument()
     *
     * @return string|null
     */
    public function getDocument(): ?string
    {
        return $this->attributes['document'];
    }

    /**
     * @method mixed getDecryptDocument()
     *
     * @return String|null
     */
    public function getDecryptDocument()
    {
        return $this->cryptoLibrary->decrypt(
            $this->attributes['document'],
            $this->getEncryptedKey()
        );
    }

    /**
     * @method mixed setDocument()
     *
     * @param string|null $email
     * @return void
     */
    public function setDocument(?string $document)
    {
        if (!empty($document) && strlen($document) > 20)
            throw new Exception("Api.clients.invalid.document", Response::HTTP_NOT_ACCEPTABLE);

        $this->attributes['document'] = $document;
    }

    /**
     * @method mixed setEncryptDocument()
     *
     * @param String|null $document
     * @return void
     */
    public function setEncryptDocument(?String $document)
    {
        if (!empty($document))
            $this->attributes['document'] = $this->cryptoLibrary->encrypt(strtolower($document), $this->getEncryptedKey());
    }

    /**
     * @method string getDocumentType()
     *
     * @return string|null
     */
    public function getDocumentType(): ?string
    {
        return $this->attributes['document_type'];
    }

    /**
     * @method mixed setDocumentType()
     *
     * @param string|null $documentType
     * @return void
     */
    public function setDocumentType(?string $documentType)
    {
        if (!empty($documentType)) {
            $this->attributes['document_type'] = $documentType;
        }
    }

    /**
     * @method mixed getPhoneSha256()
     *
     * @return string|null
     */
    public function getPhoneSha256(): ?string
    {
        return $this->attributes['phone_sha256'];
    }

    /**
     * @method mixed setPhoneSha256()
     *
     * @param string|null $phoneSha256
     * @return void
     */
    public function setPhoneSha256(?string $phoneSha256)
    {
        if (!empty($phoneSha256)) {
            $this->attributes['phone_sha256'] = $phoneSha256;
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

    public function getDeletedAt(): ?string
    {
        return $this->attributes['deleted_at'];
    }

    public function setDeletedAt(?string $deletedAt): void
    {
        $this->attributes['deleted_at'] = $deletedAt;
    }
}
