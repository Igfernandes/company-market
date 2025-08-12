<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class CheckoutRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Checkout */
        $routes->post("checkout", "Api\Operations\Finances\Checkout\Post\PostController::handle");
    }
}
