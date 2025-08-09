<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class BaseRoutes
{
    protected array $optionsWithAuthentications = ["filter" => "bearerToken"];
}
