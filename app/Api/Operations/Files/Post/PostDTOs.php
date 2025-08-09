<?php

namespace App\Api\Operations\Files\Post;

trait PostDTOs
{
    protected array $rules = [
        'package' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Api.exports.invalid.string'
            ],
        ],

    ];
}
