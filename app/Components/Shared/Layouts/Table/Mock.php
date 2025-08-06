<?php

namespace App\Components\Shared\Layouts\Table;

class Mock
{
    public const PROPS = [
        "id" => "table",
        "class" => "",
        "heads" => ["id", "Nome", "CPF", "Birthdate"],
        "ajax" => "/json/mocks/clients.json",
        "data" => [],
        "update" => "/dashboard/clients",
        "delete" => "clients",
        "attributes" => [
            "data-test" => "test"
        ]
    ];
}
