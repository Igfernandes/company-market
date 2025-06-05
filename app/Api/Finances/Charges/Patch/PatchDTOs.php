<?php

namespace App\Api\Users\Patch;

trait PatchDTOs
{
    protected array $rules = [
        'operation'  => 'string|required',
    ];
}
