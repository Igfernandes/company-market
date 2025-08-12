<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class CustomFormsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)

    {
        /** CustomForms */
        $routes->get("custom-forms", "Api\Operations\CustomForms\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("custom-forms/(:num)", "Api\Operations\CustomForms\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->post("custom-forms", "Api\Operations\CustomForms\Post\PostController::handle", $this->optionsWithAuthentications);
        $routes->put("custom-forms/(:num)", "Api\Operations\CustomForms\Put\PutController::handle/$1", $this->optionsWithAuthentications);
        $routes->delete("custom-forms/(:num)", "Api\Operations\CustomForms\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
    }
}
