<?php

namespace App\Database\Entities\Users;

use CodeIgniter\Entity\Entity;
use Exception;

class GroupEntity extends Entity
{
    protected $dates = [
        "created_at"      => null,
        "updated_at"      => null
    ];
    public $attributes = [
        'id'              => null,
        'title'           => null,
        'description'     => null,
        'status'          => null,
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
     * @param String|null $path
     * @return void
     */
    public function setDescription(?String $description)
    {
        if (!empty($description))
            $this->attributes['description'] = $description;
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
     * setUpdatedAt function
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
     * getUpdatedAt function
     *
     * @return String|null
     */
    public function getUpdatedAt(): ?String
    {
        return $this->dates['updated_at'];
    }
}
