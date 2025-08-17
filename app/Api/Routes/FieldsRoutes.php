<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;
use App\Api\BaseRoutes;

class FieldsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)

    {
        /** Fields */
        $routes->get("fields/groups", "Api\Operations\Fields\Groups\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("fields/(:num)/groups", "Api\Operations\Fields\Groups\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->get("fields/(:num)/groups/(:num)", "Api\Operations\Fields\Groups\Get\GetController::handle/$1/$2", $this->optionsWithAuthentications);
        $routes->get("fields/groups/(:num)", "Api\Operations\Fields\Groups\Get\GetController::handle/$2/$1", $this->optionsWithAuthentications);

        $routes->post("fields", "Api\Operations\Fields\Post\PostController::handle",  $this->optionsWithAuthentications);

        $routes->delete("fields/(:num)", "Api\Operations\Fields\Delete\DeleteController::handle/$1",  $this->optionsWithAuthentications);
    }
}
