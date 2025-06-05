<?php

namespace App\Api\Fields\Post;

trait PostDTOs
{
    protected array $rules = [
        'name'          => 'string|max_length[100]',
        'component'     => 'in_list[INPUT,SELECT,TEXTAREA]',
        'type'          => 'string|max_length[50]',
        'scope'         => 'in_list[USER,CLIENT,COMPANY]',
        'is_required'   => 'boolean',
        'is_sensitive'  => 'boolean',
        'group_id'      => 'integer',
        'relation_id'   => 'integer|permit_empty',
        'value'         => 'string|permit_empty',
    ];
}
