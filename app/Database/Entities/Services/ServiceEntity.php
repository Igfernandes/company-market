<?php

namespace App\Database\Entities\Services;

use CodeIgniter\Entity\Entity;
use Exception;

class ServiceEntity extends Entity
{
    public $attributes = [
        'id'             => null,
        'name'           => null,
        'type'           => null,
        'description'    => null,
        'status'         => null,
        'privacy'        => null,
        'stock'          => null,
        'reservations'   => null,
        'photo'          => null,
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
     * getName function
     *
     * @return String|null
     */
    public function getName(): ?String
    {
        return $this->attributes['name'];
    }

    /**
     * setName function
     *
     * @param String|null $name
     * @return void
     */
    public function setName(?String $name)
    {
        if (!empty($name))
            $this->attributes['name'] = $name;
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
        if (!empty($type))
            $this->attributes['type'] = $type;
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
     * getPrivacy function
     *
     * @return String|null
     */
    public function getPrivacy(): ?String
    {
        return $this->attributes['privacy'];
    }

    /**
     * setPrivacy function
     *
     * @param String|null $privacy
     * @return void
     */
    public function setPrivacy(?String $privacy)
    {
        if (!empty($privacy))
            $this->attributes['privacy'] = $privacy;
    }

    /**
     * getStock function
     *
     * @return Int|null
     */
    public function getStock(): ?Int
    {
        return $this->attributes['stock'];
    }

    /**
     * setStock function
     *
     * @param Int|null $stock
     * @return void
     */
    public function setStock(?Int $stock)
    {
        if (!is_null($stock) && $stock >= 0)
            $this->attributes['stock'] = $stock;
        else
            throw new Exception("Stock cannot be negative.");
    }

    /**
     * getReservations function
     *
     * @return Int|null
     */
    public function getReservations(): ?Int
    {
        return $this->attributes['reservations'];
    }

    /**
     * setReservations function
     *
     * @param Int|null $reservations
     * @return void
     */
    public function setReservations(?Int $reservations)
    {
        if (!is_null($reservations) && $reservations >= 0)
            $this->attributes['reservations'] = $reservations;
        else
            throw new Exception("Reservations cannot be negative.");
    }

    /**
     * getPhoto function
     *
     * @return String|null
     */
    public function getPhoto(): ?String
    {
        return $this->attributes['photo'];
    }

    /**
     * setPhoto function
     *
     * @param String|null $photo
     * @return void
     */
    public function setPhoto(?String $photo)
    {
        if (!empty($photo))
            $this->attributes['photo'] = $photo;
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
