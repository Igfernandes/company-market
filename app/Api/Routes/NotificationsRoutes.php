<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;
use App\Api\BaseRoutes;

class NotificationsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Notifications */
        $routes->get("notifications", "Api\Operations\Notifications\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("notifications/(:num)", "Api\Operations\Notifications\Get\GetController::handle/$1", $this->optionsWithAuthentications);


        $routes->post("notifications/subscribe", "Api\Operations\Notifications\Subscribes\Post\PostController::handle");
    }
}
