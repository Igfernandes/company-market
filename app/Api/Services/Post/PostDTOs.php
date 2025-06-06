<?php

namespace App\Api\Services\Post;

trait PostDTOs
{
    protected array $rules = [
        'file' => [
            'label'  => 'photo',
            'rules'  => 'uploaded[photo]|max_size[photo,1024]|mime_in[photo,image/png,image/jpeg]|permit_empty'
        ],
        'name' => [
            'label'  => 'name',
            'rules'  => 'string|required',
        ],
        'type' => [
            'label'  => 'type',
            'rules'  => 'string|in_list[APPELLANT, PUNCTUAL]|required',
        ],
        'description' => [
            'label'  => 'description',
            'rules'  => 'string|permit_empty',
        ],
        'privacy' => [
            'label'  => 'privacy',
            'rules'  => 'in_list[PUBLIC, PRIVATE]|required',
        ],
        'stock' => [
            'label'  => 'stock',
            'rules'  => 'integer|is_natural|permit_empty',
        ],
        'reservations' => [
            'label'  => 'reservations',
            'rules'  => 'integer|is_natural|permit_empty',
        ],
        'address' => [
            'label'  => 'address',
            'rules'  => 'string|permit_empty',
        ],
        'realized_at' => [
            'label'  => 'realized_at',
            'rules'  => 'string|permit_empty',
        ],
        'expired_at' => [
            'label'  => 'expired_at',
            'rules'  => 'string|permit_empty',
        ],
    ];
}
