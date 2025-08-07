<?php

namespace App\Routes\Sandbox\Users;

use App\Routes\BaseRoutes;
use CodeIgniter\Router\RouteCollection;

class UsersRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Sandbox */
        $routes->get("sandbox/users", "Api\Sandbox\Users\Get\GetController::handle");
        $routes->get("sandbox/users/(:num)", "Api\Sandbox\Users\Get\GetController::handle/$1");
    }
}
