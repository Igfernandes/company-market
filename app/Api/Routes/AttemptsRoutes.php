<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;
use App\Api\BaseRoutes;
use App\Api\Operations\Attempts\Contact\Post\PostController;
use App\Api\Operations\Attempts\Subscribe\Post\PostController as SubscribePostController;

class AttemptsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Checkout */
        $routes->post("contact", [PostController::class, "handle"]);
        $routes->post("subscribe", [SubscribePostController::class, "handle"]);
    }
}
