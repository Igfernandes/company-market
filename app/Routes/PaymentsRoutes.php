<?php

namespace App\Routes;

use CodeIgniter\Router\RouteCollection;

class PaymentsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Payments */
        $routes->get("payments", "Api\Finances\Payments\Get\GetController::handle",  $this->optionsWithAuthentications);
        $routes->get("payments/(:num)", "Api\Finances\Payments\Get\GetController::handle/$1",  $this->optionsWithAuthentications);
    }
}
