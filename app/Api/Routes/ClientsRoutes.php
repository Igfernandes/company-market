<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;
use App\Api\BaseRoutes;

class ClientsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Clients */
        $routes->get("clients", "Api\Operations\Clients\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("clients/(:num)", "Api\Operations\Clients\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->post("clients", "Api\Operations\Clients\Post\PostController::handle", $this->optionsWithAuthentications);
        $routes->patch("clients", "Api\Operations\Clients\Patch\PatchController::handle", $this->optionsWithAuthentications);
        $routes->delete("clients/(:num)", "Api\Operations\Clients\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
        $routes->delete("clients", "Api\Operations\Clients\Delete\DeleteController::handle", $this->optionsWithAuthentications);
        $routes->post("clients/(:num)/fields", "Api\Operations\Clients\Fields\Post\PostController::handle/$1", $this->optionsWithAuthentications);
        $routes->put("clients/(:num)", "Api\Operations\Clients\Put\PutController::handle/$1", $this->optionsWithAuthentications);

        $routes->get("clients/dispatchers", "Api\Operations\Clients\Dispatchers\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("clients/dispatchers/(:num)", "Api\Operations\Clients\Dispatchers\Get\GetController::handle/$1", $this->optionsWithAuthentications);

        $routes->get("clients/fields", "Api\Operations\Clients\Fields\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("clients/(:num)/fields", "Api\Operations\Clients\Fields\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->get("clients/preview", "Api\Operations\Clients\GetPreview\GetPreviewController::handle");

        $routes->post("clients/services/(:num)", "Api\Operations\Clients\Services\Post\PostController::handle/$1", $this->optionsWithAuthentications);
        $routes->get("clients/services/(:num)", "Api\Operations\Clients\Services\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->patch("clients/services", "Api\Operations\Clients\Services\Patch\PatchController::handle");

        $routes->get("clients/categories", "Api\Operations\Clients\Categories\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->post("clients/categories", "Api\Operations\Clients\Categories\Post\PostController::handle", $this->optionsWithAuthentications);
    }
}
