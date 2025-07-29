<?php

namespace App\Components\Forms\Link;

use App\Components\BaseComponents;


class Link extends BaseComponents{
    public string $origin = "components/shared/forms/link";
    public array $props = [];

    public function __construct(?string $name = "", 
    ?string $id = "", 
    ?string $label = "", 
    ?string $className = "", 
    ?string $href = "", 
    ?bool $readonly = null,
    ) {
        $this->props = compact([
            "name", 
            "id",
            "label",
            "className",
            "readonly",
            "href"
        ]);
    }
}