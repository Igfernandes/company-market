<?php

namespace App\Api\Clients\Fields\Get;

trait GetDTOs
{
    protected array $rules = [
        'name'          => [
            "rules" => 'string|max_length[100]|permit_empty',
            'errors' => [
                'string' => 'Api.clients.fields.invalid.name',
                'max_length' => 'Api.clients.fields.invalid.name_max_length_100',
            ],
        ],
        'name_contains' => [
            "rules" => 'string|max_length[100]|permit_empty',
            'errors' => [
                'string' => 'Api.clients.fields.invalid.name',
                'max_length' => 'Api.clients.fields.invalid.name_max_length_100',
            ],
        ],
        'component'     => [
            "rules" => 'in_list[INPUT,SELECT,TEXTAREA]|permit_empty',
            'errors' => [
                'in_list' => 'Api.clients.fields.invalid.component',
            ],
        ],
        'type'    => [
            "rules" => 'string|max_length[50]|permit_empty',
            'errors' => [
                'string' => 'Api.clients.fields.invalid.type',
                'max_length' => 'Api.clients.fields.invalid.type_max_length_100',
            ],
        ],
        'scope'    => [
            "rules" => 'in_list[USER,CLIENT,COMPANY]|permit_empty',
            'errors' => [
                'in_list' => 'Api.clients.fields.invalid.scope'
            ],
        ],
        'is_file'       =>  [
            "rules" => 'in_list[0,1]|permit_empty',
            'errors' => [
                'in_list' => 'Api.clients.fields.invalid.is_file'
            ],
        ],
        'is_required'   => [
            "rules" => 'in_list[0,1]|permit_empty',
            'errors' => [
                'in_list' => 'Api.clients.fields.invalid.is_required'
            ],
        ],
        'is_sensitive'  => [
            "rules" => 'in_list[0,1]|permit_empty',
            'errors' => [
                'in_list' => 'Api.clients.fields.invalid.is_sensitive'
            ],
        ],
        'group_id'      => [
            "rules" =>   'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.clients.fields.invalid.group_id'
            ],
        ],
        'client_id'     => [
            "rules" =>   'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.clients.fields.invalid.client_id'
            ],
        ],
        'id'            => [
            "rules" =>   'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.clients.fields.invalid.id'
            ],
        ]
    ];
}
