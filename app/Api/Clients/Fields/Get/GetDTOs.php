<?php

namespace App\Api\Clients\Fields\Get;

trait GetDTOs
{
    protected array $rules = [
        'name'          => 'string|max_length[100]|permit_empty',
        'name_contains' => 'string|max_length[100]|permit_empty',
        'component'     => 'in_list[INPUT,SELECT,TEXTAREA]|permit_empty',
        'type'          => 'string|max_length[50]|permit_empty',
        'scope'         => 'in_list[USER,CLIENT,COMPANY]|permit_empty',
        'is_file'       => 'in_list[0,1]|permit_empty',
        'is_required'   => 'in_list[0,1]|permit_empty',
        'is_sensitive'  => 'in_list[0,1]|permit_empty',
        'group_id'      => 'integer|permit_empty',
        'client_id'     => 'integer|permit_empty',
        'id'            => 'integer|permit_empty'
    ];
}
