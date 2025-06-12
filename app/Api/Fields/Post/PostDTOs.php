<?php

namespace App\Api\Fields\Post;

trait PostDTOs
{
    protected array $rules = [
        'name' => [
            'rules'  => 'string|max_length[100]',
            'errors' => [
                'string'     => 'Api.fields.invalid.name',
                'max_length' => 'Api.fields.invalid.name_max_length_100',
            ],
        ],
        'component' => [
            'rules'  => 'in_list[INPUT,SELECT,TEXTAREA]',
            'errors' => [
                'in_list' => 'Api.fields.invalid.component',
            ],
        ],
        'type' => [
            'rules'  => 'string|max_length[50]',
            'errors' => [
                'string'     => 'Api.fields.invalid.type',
                'max_length' => 'Api.fields.invalid.type_max_length_50',
            ],
        ],
        'scope' => [
            'rules'  => 'in_list[USER,CLIENT,COMPANY]',
            'errors' => [
                'in_list' => 'Api.fields.invalid.scope',
            ],
        ],
        'is_required' => [
            'rules'  => 'boolean',
            'errors' => [
                'boolean' => 'Api.fields.invalid.is_required',
            ],
        ],
        'is_sensitive' => [
            'rules'  => 'boolean',
            'errors' => [
                'boolean' => 'Api.fields.invalid.is_sensitive',
            ],
        ],
        'group_id' => [
            'rules'  => 'integer',
            'errors' => [
                'integer' => 'Api.fields.invalid.group_id',
            ],
        ],
        'relation_id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.fields.invalid.relation_id',
            ],
        ],
        'value' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.fields.invalid.value',
            ],
        ],
    ];
}
