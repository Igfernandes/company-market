<?php

namespace App\Routes;

use CodeIgniter\Router\RouteCollection;

class AuthenticationsRoutes extends BaseRoutes
{
    public function load(RouteCollection $routes)
    {
        /** Authentications */
        $routes->post("auth", "Api\Authentications\Auth\PostController::handle");
        $routes->post("csrf", "Api\Authentications\CSRF\PostController::handle");
        $routes->post("remember-me", "Api\Authentications\RememberMe\PostController::handle");
    }
}
