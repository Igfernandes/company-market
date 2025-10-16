<?php

namespace App\Components\Shared\Utils\Modal;

class Mock
{
    public const PROPS = [
        "type" => "warning",
        "title" => "[title]",
        "subtitle" => "[subtitle]",
        "content" => '<div class="text-justify md:text-center" component="modal:message"><p class="text-md">[message]</p></div>',
        "left" => "Cancelar",
        "right" => "Confirmar",
        "isActive" => true
    ];
}
