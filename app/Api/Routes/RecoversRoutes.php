<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class RecoversRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Recover */
        $routes->post("recovers/password", "Api\Recovers\Password\Post\PostController::handle");
        $routes->put("recovers/password", "Api\Recovers\Password\Put\PutController::handle");
    }
}
