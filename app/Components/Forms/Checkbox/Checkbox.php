<?php

namespace App\Components\Forms\Checkbox;

use App\Components\BaseComponents;


class Checkbox extends BaseComponents{
    public string $origin = "components/shared/forms/checkbox";
    public array $props = [];

    public function __construct(?string $name = "", 
    ?string $id = "", 
    ?string $label = "", 
    ?string $className = "", 
    ?string $required = "", 
    ?string $value = "1", 
    ?bool $disabled = null, 
    ?bool $readonly = null,
    ?bool $checked = null,
    ?array $attributes = [],
    ) {
        $this->props = compact([
            "name", 
            "id",
            "label",
            "className",
            "required",
            "attributes",
            "disabled",
            "readonly",
            "value",
            "checked",
            "attributes"
        ]);
    }
}