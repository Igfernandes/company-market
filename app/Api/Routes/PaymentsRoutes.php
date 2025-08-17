<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;
use App\Api\BaseRoutes;

class PaymentsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Payments */
        $routes->get("payments", "Api\Operations\Finances\Payments\Get\GetController::handle",  $this->optionsWithAuthentications);
        $routes->get("payments/(:num)", "Api\Operations\Finances\Payments\Get\GetController::handle/$1",  $this->optionsWithAuthentications);
    }
}
