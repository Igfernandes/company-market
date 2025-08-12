<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class ExportsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        $routes->post("exports", "Api\Operations\Exports\Post\PostController::handle",  $this->optionsWithAuthentications);
    }
}
