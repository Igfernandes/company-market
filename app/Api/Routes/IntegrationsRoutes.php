<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class IntegrationsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Integrations */
        $routes->post("integrations", "Api\Operations\Integrations\Post\PostController::handle",  $this->optionsWithAuthentications);
        $routes->get("integrations", "Api\Operations\Integrations\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("integrations/(:num)", "Api\Operations\Integrations\Get\GetController::handle/$1", $this->optionsWithAuthentications);
    }
}
