<?php

namespace App\Routes;

use CodeIgniter\Router\RouteCollection;

class BaseRoutes
{
    protected array $optionsWithAuthentications = ["filter" => "bearerToken"];
}
