<?php

namespace App\Database\Entities\CustomForms;

use CodeIgniter\Entity\Entity;
use Exception;

use function PHPUnit\Framework\isJson;

class CustomFormEntity extends Entity
{
    public $attributes = [
        'id'              => null,
        'name'            => null,
        'slug'            => null,
        'components'      => null,
        'description'     => null,
        'status'          => null,
        'created_at'      => null,
        'updated_at'      => null
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
        $session = session();
        $LANGUAGE = $session->get("language");
        $PAGE_TRANSLATE = lang('Words.name', [], $LANGUAGE);

        if (strlen($name) > 200)
            throw new Exception(lang('Validation.max_length', [
                "field" => $PAGE_TRANSLATE,
                "param" => 250
            ], $LANGUAGE), BAD_REQUEST);

        if (!empty($name))
            $this->attributes['name'] = $name;
    }

    
    /**
     * getSlug function
     *
     * @return String|null
     */
    public function getSlug(): ?String
    {
        return $this->attributes['slug'];
    }

    /**
     * setSlug function
     *
     * @param String|null $slug
     * @return void
     */
    public function setSlug(?String $slug)
    {
        $session = session();
        $LANGUAGE = $session->get("language");
        $PAGE_TRANSLATE = lang('Words.slug', [], $LANGUAGE);

        if (strlen($slug) > 200)
            throw new Exception(lang('Validation.max_length', [
                "field" => $PAGE_TRANSLATE,
                "param" => 250
            ], $LANGUAGE), BAD_REQUEST);

        if (!empty($slug))
            $this->attributes['slug'] = $slug;
    }

    /**
     * getComponents function
     *
     * @return String|null
     */
    public function getComponents(): ?String
    {
        return $this->attributes['components'];
    }

    /**
     * setComponents function
     *
     * @param String|null $components
     * @return void
     */
    public function setComponents(?String $components)
    {
        $session = session();
        $LANGUAGE = $session->get("language");

        if (!isJson($components))
            throw new Exception(lang('Validation.invalid_json', [
                "json" => "components"
            ], $LANGUAGE), INTERNAL_ERROR);

        if (!empty($components))
            $this->attributes['components'] = $components;
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
        $session = session();
        $LANGUAGE = $session->get("language");

        if (strlen($description) > 250)
            throw new Exception(lang('Validation.max_length', [
                "field" => "description",
                "param" => 250
            ], $LANGUAGE), BAD_REQUEST);

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
    public function setStatus(String $status)
    {
        $session = session();

        if (array_search($status, ["PUBLISHED", "DRAFT"]) === false)
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

    /**
     * setUpdatedAt function
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
     * getUpdatedAt function
     *
     * @return String|null
     */
    public function getUpdatedAt(): ?String
    {
        return $this->attributes['updated_at'];
    }
}
