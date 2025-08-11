<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class IntegrationsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Integrations */
        $routes->post("integrations", "Api\Integrations\Post\PostController::handle",  $this->optionsWithAuthentications);
        $routes->get("integrations", "Api\Integrations\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("integrations/(:num)", "Api\Integrations\Get\GetController::handle/$1", $this->optionsWithAuthentications);
    }
}
