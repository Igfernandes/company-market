<?php

namespace App\Api\Operations\CustomForms\Post;

trait PostDTOs
{
    protected array $rules = [
        'name' => [
            'rules' => 'string|required',
            'errors' => [
                'string'   => 'Api.custom_forms.invalid.name',
                'required' => 'Api.custom_forms.invalid.name',
            ],
        ],
        'status' => [
            'label'  => 'status',
            'rules'  => 'string|in_list[PUBLISHED,DRAFT]|required',
            'errors' => [
                'string'   => 'Api.services.invalid.status',
                'in_list'  => 'Api.services.invalid.status',
                'required' => 'Api.services.invalid.status',
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
        'color_mark' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'in_list' => 'Api.custom_forms.invalid.color_mark',
            ],
        ],
        'thanks_message' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'in_list' => 'Api.custom_forms.invalid.thanks_message',
            ],
        ],
        'service_id' => [
            'rules' => 'integer|permit_empty',
            'errors' => [
                'in_list' => 'Api.custom_forms.invalid.service_id',
            ],
        ],
        'started_at' => [
            'rules' => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.custom_forms.invalid.started_at',
            ],
        ],
        'expired_at' => [
            'rules' => 'valid_date|permit_empty',
            'errors' => [
                'in_list' => 'Api.custom_forms.invalid.expired_at',
            ],
        ],
    ];
}
