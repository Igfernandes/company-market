<?php

namespace App\Database\Entities\Clients;

use App\Libraries\Crypto\Crypto;
use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;
use Exception;

class CategoryEntity extends Entity
{
    use EntityEnhancerTrait;
    
    public $attributes = [
        'id'              => null,
        'name'            => null,
        'position'        => null,
        'description'     => null,
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

        if (strlen($name) > 100)
            throw new Exception(lang('Validation.max_length', [
                "field" => $NAME_TRANSLATE,
                "param" => 100
            ]), BAD_BUSINESS_RULES);

        if (!empty($name)) {
            $this->attributes['name'] = $name;
        }
    }

    /**
     * @method mixed getPosition()
     *
     * @return int|null
     */
    public function getPosition(): ?int
    {
        return $this->attributes['position'];
    }

    /**
     * @method mixed setPosition()
     *
     * @param int|null $setPosition
     * @return void
     */
    public function setPosition(?int $position)
    {
        $this->attributes['position'] = $position;
    }

    /**
     * @method mixed getDescription()
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->attributes['description'];
    }

    /**
     * @method mixed setDescription()
     *
     * @param string|null $setDescription
     * @return void
     */
    public function setDescription(?string $description)
    {
        $DESCRIPTION_TRANSLATE = lang('Words.description');

        if (strlen($description) > 300)
            throw new Exception(lang('Validation.max_length', [
                "field" => $DESCRIPTION_TRANSLATE,
                "param" => 300
            ]), BAD_BUSINESS_RULES);

        if (!empty($description)) {
            $this->attributes['description'] = $description;
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
