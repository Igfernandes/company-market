<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;
use App\Api\BaseRoutes;

class PermissionsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Permissions */
        $routes->get("permissions", "Api\Operations\Permissions\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("permissions/groups", "Api\Operations\Permissions\Groups\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("permissions/groups/(:num)", "Api\Operations\Permissions\Groups\Get\GetController::handle/$1", $this->optionsWithAuthentications);
    }
}
