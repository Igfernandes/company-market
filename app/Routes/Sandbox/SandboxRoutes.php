<?php

namespace App\Routes\Sandbox;

use App\Routes\BaseRoutes;
use App\Routes\Sandbox\Users\UsersRoutes;
use CodeIgniter\Router\RouteCollection;

class SandboxRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        $usersRoutes = new UsersRoutes();
        $usersRoutes->load($routes);
    }
}
