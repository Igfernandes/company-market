<?php

namespace App\Database\Entities\Dispatchers;

use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;

class ContentEntity extends Entity
{
    use EntityEnhancerTrait;

    public $attributes = [
        'id'             => null,
        'title'          => null,
        'description'    => null,
        'status'         => null,
        'image'          => null,
        'address'        => null,
        'closed_at'     => null,
        'realized_at'    => null,
        'created_at'     => null,
        'updated_at'     => null
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
     * getTitle function
     *
     * @return String|null
     */
    public function getTitle(): ?String
    {
        return $this->attributes['title'];
    }

    /**
     * setTitle function
     *
     * @param String|null $title
     * @return void
     */
    public function setTitle(?String $title)
    {
        if (!empty($title))
            $this->attributes['title'] = $title;
    }

    /**
     * getDescription function
     *
     * @return String|null
     */
    public function getDescription(): ?String
    {
        return $this->attributes['description'];
    }

    /**
     * setDescription function
     *
     * @param String|null $description
     * @return void
     */
    public function setDescription(?String $description)
    {
        if (!empty($description))
            $this->attributes['description'] = $description;
    }

    /**
     * getStatus function
     *
     * @return String|null
     */
    public function getStatus(): ?String
    {
        return $this->attributes['status'];
    }

    /**
     * setStatus function
     *
     * @param String|null $status
     * @return void
     */
    public function setStatus(?String $status)
    {
        if (!empty($status))
            $this->attributes['status'] = $status;
    }

    /**
     * getImage function
     *
     * @return String|null
     */
    public function getImage(): ?String
    {
        return $this->attributes['image'];
    }

    /**
     * setImage function
     *
     * @param String|null $image
     * @return void
     */
    public function setImage(?String $image)
    {
        $this->attributes['image'] = $image;
    }

    /**
     * getAddress function
     *
     * @return String|null
     */
    public function getAddress(): ?String
    {
        return $this->attributes['address'];
    }

    /**
     * setAddress function
     *
     * @param String|null $address
     * @return void
     */
    public function setAddress(?String $address)
    {
        if (!empty($realizedAt))
            $this->attributes['address'] = $address;
    }

    /**
     * @method mixed getRealizedAt()
     *
     * @return string|null
     */
    public function getRealizedAt(): ?string
    {
        return $this->attributes['realized_at'];
    }

    /**
     * @method mixed setRealizedAt()
     *
     * @param string|null $realizedAt
     * @return void
     */
    public function setRealizedAt(?string $realizedAt)
    {
        if (!empty($realizedAt)) {
            $this->attributes['realized_at'] = $realizedAt;
        }
    }

    /**
     * @method mixed getClosedAt()
     *
     * @return string|null
     */
    public function getClosedAt(): ?string
    {
        return $this->attributes['closed_at'];
    }

    /**
     * @method mixed setClosedAt()
     *
     * @param string|null $closedAt
     * @return void
     */
    public function setClosedAt(?string $closedAt)
    {
        if (!empty($closedAt)) {
            $this->attributes['closed_at'] = $closedAt;
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
