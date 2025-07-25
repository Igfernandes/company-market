<?php

namespace App\Routes;

use CodeIgniter\Router\RouteCollection;

class ServicesRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Services */
        $routes->get("services", "Api\Services\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("services/(:num)", "Api\Services\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->get("services/preview", "Api\Services\GetPreview\GetPreviewController::handle");

        $routes->post("services", "Api\Services\Post\PostController::handle", $this->optionsWithAuthentications);
        $routes->put("services/(:num)", "Api\Services\Put\PutController::handle/$1", $this->optionsWithAuthentications);
        $routes->delete("services/(:num)", "Api\Services\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
    }
}
