<?php

namespace App\Database\Entities\CustomForms;

use CodeIgniter\Entity\Entity;
use Exception;

use function PHPUnit\Framework\isJson;

class CustomFormsEntity extends Entity
{
    protected $dates = [
        "created_at"      => null,
        "updated_at"      => null
    ];
    public $attributes = [
        'id'              => null,
        'page'         => null,
        'components'         => null,
        'status'            => null
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
     * getPage function
     *
     * @return String|null
     */
    public function getPage(): ?String
    {
        return $this->attributes['page'];
    }

    /**
     * setPage function
     *
     * @param String|null $page
     * @return void
     */
    public function setPage(?String $page)
    {
        $session = session();
        $LANGUAGE = $session->get("language");
        $PAGE_TRANSLATE = lang('Words.page', [], $LANGUAGE);

        if (strlen($page) > 250)
            throw new Exception(lang('Validation.max_length', [
                "field" => $PAGE_TRANSLATE,
                "param" => 250
            ], $LANGUAGE), BAD_REQUEST);

        if (!empty($page))
            $this->attributes['page'] = $page;
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
     * getTarget function
     *
     * @return String|null
     */
    public function getTarget(): ?String
    {
        return $this->attributes['target'];
    }

    /**
     * setTarget function
     *
     * @param String|null $target
     * @return void
     */
    public function setTarget(?String $target)
    {
        $session = session();
        $LANGUAGE = $session->get("language");

        if (strlen($target) > 250)
            throw new Exception(lang('Validation.max_length', [
                "field" => "target",
                "param" => 250
            ], $LANGUAGE), BAD_REQUEST);

        if (!empty($target))
            $this->attributes['target'] = $target;
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
