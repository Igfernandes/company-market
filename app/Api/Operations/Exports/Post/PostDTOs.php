<?php

namespace App\Api\Operations\Exports\Post;

trait PostDTOs
{
    protected array $rules = [
        'in_ids' => [
            'rules'  => 'permit_empty',
            'errors' => [
                'required' => 'Api.exports.invalid.in_ids'
            ],
        ],
        'entity' => [
            'rules' => 'string|required',
            'errors' => [
                'string'  => 'Api.exports.invalid.entity',
                'required' => 'Api.exports.invalid.required',
            ]
        ],
        'type' => [
            'rules' => 'in_list[EXCEL,PDF]|required',
            'errors' => [
                'in_list'   => 'Api.exports.invalid.type',
                'required'  => 'Api.exports.invalid.required',
            ]
        ]
    ];
}
