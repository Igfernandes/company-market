<?php

namespace App\Routes;

use CodeIgniter\Router\RouteCollection;

class FormsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)

    {
        /** Forms */
        $routes->get("forms/(:num)", "Api\Forms\Get\GetController::handle/$1");
        $routes->get("forms", "Api\Forms\Get\GetController::handle");
        $routes->post("forms", "Api\Forms\Post\PostController::handle");

        $routes->get("forms/(:num)/fills", "Api\Forms\Fills\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->get("forms/(:num)/fills/(:segment)", "Api\Forms\Fills\Get\GetController::handle/$1/$2", $this->optionsWithAuthentications);
        $routes->delete("forms/(:num)/fills/(:segment)", "Api\Forms\Fills\Delete\DeleteController::handle/$1/$2", $this->optionsWithAuthentications);
    }
}
