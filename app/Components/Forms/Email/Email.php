<?php

namespace App\Components\Forms\Email;

use App\Components\BaseComponents;

class Email extends BaseComponents{
    public string $origin = "components/shared/forms/email";
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