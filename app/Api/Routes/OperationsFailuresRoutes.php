<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class OperationsFailuresRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Operations */
        $routes->get("operations-failures", "Api\Finances\OperationsFailures\Get\GetController::handle",  $this->optionsWithAuthentications);
        $routes->get("operations-failures/(:num)", "Api\Finances\OperationsFailures\Get\GetController::handle/$1",  $this->optionsWithAuthentications);
        $routes->post("operations-failures/(:num)", "Api\Finances\OperationsFailures\Post\PostController::handle/$1",  $this->optionsWithAuthentications);
    }
}
