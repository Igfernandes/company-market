<?php

namespace App\Components\Forms\Password\PasswordToggle;

use App\Components\BaseComponents;

class PasswordToggle extends BaseComponents{
    public string $origin = "components/shared/forms/password/passwordToggle";
    public array $props = [];

    public function __construct(?string $name = "", 
    ?string $id = "", 
    ?string $label = "", 
    ?string $placeholder = "", 
    ?string $className = "", 
    ?string $required = "", 
    ?array $attributes = [], 
    ?bool $disabled = null, 
    ?bool $readonly = null
    ) {
        $this->props = compact([
            "name", 
            "label", 
            "id",
            "placeholder",
            "className",
            "required",
            "attributes",
            "disabled",
            "readonly"
        ]);
    }
}