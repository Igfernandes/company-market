<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class FieldsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)

    {
        /** Fields */
        $routes->get("fields/groups", "Api\Fields\Groups\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("fields/(:num)/groups", "Api\Fields\Groups\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->get("fields/(:num)/groups/(:num)", "Api\Fields\Groups\Get\GetController::handle/$1/$2", $this->optionsWithAuthentications);
        $routes->get("fields/groups/(:num)", "Api\Fields\Groups\Get\GetController::handle/$2/$1", $this->optionsWithAuthentications);

        $routes->post("fields", "Api\Fields\Post\PostController::handle",  $this->optionsWithAuthentications);

        $routes->delete("fields/(:num)", "Api\Fields\Delete\DeleteController::handle/$1",  $this->optionsWithAuthentications);
    }
}
