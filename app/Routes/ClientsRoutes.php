<?php

namespace App\Routes;

use CodeIgniter\Router\RouteCollection;

class ClientsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Clients */
        $routes->get("clients", "Api\Clients\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("clients/(:num)", "Api\Clients\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->post("clients", "Api\Clients\Post\PostController::handle", $this->optionsWithAuthentications);
        $routes->patch("clients", "Api\Clients\Patch\PatchController::handle", $this->optionsWithAuthentications);
        $routes->delete("clients/(:num)", "Api\Clients\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
        $routes->delete("clients", "Api\Clients\Delete\DeleteController::handle", $this->optionsWithAuthentications);
        $routes->post("clients/(:num)/fields", "Api\Clients\Fields\Post\PostController::handle/$1", $this->optionsWithAuthentications);
        $routes->put("clients/(:num)", "Api\Clients\Put\PutController::handle/$1", $this->optionsWithAuthentications);

        $routes->get("clients/dispatchers", "Api\Clients\Dispatchers\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("clients/dispatchers/(:num)", "Api\Clients\Dispatchers\Get\GetController::handle/$1", $this->optionsWithAuthentications);

        $routes->get("clients/fields", "Api\Clients\Fields\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("clients/(:num)/fields", "Api\Clients\Fields\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->get("clients/preview", "Api\Clients\GetPreview\GetPreviewController::handle");

        $routes->get("clients/categories", "Api\Clients\Categories\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->post("clients/categories", "Api\Clients\Categories\Post\PostController::handle", $this->optionsWithAuthentications);
    }
}
