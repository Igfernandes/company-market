<?php

namespace App\Api\Services\Put;

trait PutDTOs
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
            'rules'  => 'integer|is_natural_no_zero|permit_empty',
        ],
        'reservations' => [
            'label'  => 'stock',
            'rules'  => 'integer|is_natural|permit_empty',
        ],
    ];
}
