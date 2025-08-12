<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class FormsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)

    {
        /** Forms */
        $routes->get("forms/(:num)", "Api\Operations\Forms\Get\GetController::handle/$1");
        $routes->get("forms", "Api\Operations\Forms\Get\GetController::handle");
        $routes->post("forms", "Api\Operations\Forms\Post\PostController::handle");

        $routes->get("forms/(:num)/fills", "Api\Operations\Forms\Fills\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->get("forms/(:num)/fills/(:segment)", "Api\Operations\Forms\Fills\Get\GetController::handle/$1/$2", $this->optionsWithAuthentications);
        $routes->put("forms/(:num)/fills/(:segment)", "Api\Operations\Forms\Fills\Put\PutController::handle/$1/$2", $this->optionsWithAuthentications);
        $routes->delete("forms/(:num)/fills/(:segment)", "Api\Operations\Forms\Fills\Delete\DeleteController::handle/$1/$2", $this->optionsWithAuthentications);

        $routes->post("forms/(:segment)/services/(:num)", "Api\Operations\Forms\Services\Post\PostController::handle/$1/$2", $this->optionsWithAuthentications);
    }
}
