<?php

namespace App\Api\Clients\Patch;

trait PatchDTOs
{
    protected array $rules = [
        'path'   => 'string',
        'data' => 'required'
    ];
}
