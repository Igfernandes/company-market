<?php

namespace App\Interfaces;

interface IUseCases
{
    public function execute(array $payload): object;
}
