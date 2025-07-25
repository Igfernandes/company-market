<?php

namespace App\Api\Forms\Services\Post;

trait PostDTOs
{
    protected array $rules = [
        'package' => [
            'rules' => 'string|required',
            'errors' => [
                'required' => 'Api.forms.invalid.package',
            ],
        ],
        'service_id' => [
            'rules' => 'integer|required',
            'errors' => [
                'integer'  => 'Api.service.invalid.id',
                'required' => 'Api.service.invalid.id',
            ],
        ],
    ];
}
