<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class AuthenticationsRoutes extends BaseRoutes
{
    public function load(RouteCollection $routes)
    {
        /** Authentications */
        $routes->post("auth", "Api\Operations\Authentications\Auth\PostController::handle");
        $routes->post("remember-me", "Api\Operations\Authentications\RememberMe\PostController::handle");
    }
}
