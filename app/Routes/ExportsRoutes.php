<?php

namespace App\Routes;

use CodeIgniter\Router\RouteCollection;

class ExportsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        $routes->post("exports", "Api\Exports\Post\PostController::handle",  $this->optionsWithAuthentications);
    }
}
