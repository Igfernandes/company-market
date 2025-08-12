<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class ServicesRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Services */
        $routes->get("services", "Api\Operations\Services\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("services/(:num)", "Api\Operations\Services\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->get("services/preview", "Api\Operations\Services\GetPreview\GetPreviewController::handle");

        $routes->post("services", "Api\Operations\Services\Post\PostController::handle", $this->optionsWithAuthentications);
        $routes->put("services/(:num)", "Api\Operations\Services\Put\PutController::handle/$1", $this->optionsWithAuthentications);
        $routes->delete("services/(:num)", "Api\Operations\Services\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
    }
}
