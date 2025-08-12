<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class NotificationsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Notifications */
        $routes->get("notifications", "Api\Operations\Notifications\Get\GetController::handle");

        $routes->post("notifications/subscribe", "Api\Operations\Notifications\Subscribes\Post\PostController::handle");
    }
}
