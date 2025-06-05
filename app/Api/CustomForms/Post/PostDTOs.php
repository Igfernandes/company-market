<?php

namespace App\Api\CustomForms\Post;

trait PostDTOs
{
    protected array $rules = [
        'name' => [
            'label'  => 'name',
            'rules'  => 'string|required'
        ],
        'components' => [
            'label'  => 'components',
            'rules'  => 'string|required',
        ],
        'description' => [
            'label'  => 'description',
            'rules'  => 'string|permit_empty',
        ],
        'status' => [
            'label'  => 'status',
            'rules'  => 'in_list[PUBLISHED, DRAFT]|permit_empty',
        ],
    ];
}
