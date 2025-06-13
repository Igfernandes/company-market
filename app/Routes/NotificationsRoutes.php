<?php

namespace App\Routes;

use CodeIgniter\Router\RouteCollection;

class NotificationsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Notifications */
        $routes->get("notifications", "Api\Notifications\Get\GetController::handle");

        $routes->post("notifications/subscribe", "Api\Notifications\Subscribes\Post\PostController::handle");
    }
}
