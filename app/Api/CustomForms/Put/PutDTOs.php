<?php

namespace App\Api\CustomForms\Put;

trait PutDTOs
{
    protected array $rules = [
        'name' => [
            'rules' => 'string|required',
            'errors' => [
                'string'   => 'Api.custom_forms.invalid.name',
                'required' => 'Api.custom_forms.invalid.name',
            ],
        ],
        'components' => [
            'rules' => 'string|required',
            'errors' => [
                'string'   => 'Api.custom_forms.invalid.components',
                'required' => 'Api.custom_forms.invalid.components',
            ],
        ],
        'description' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.custom_forms.invalid.description',
            ],
        ],
        'status' => [
            'rules' => 'in_list[PUBLISHED, DRAFT]|permit_empty',
            'errors' => [
                'in_list' => 'Api.custom_forms.invalid.status',
            ],
        ],
    ];
}
