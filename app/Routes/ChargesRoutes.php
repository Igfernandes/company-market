<?php

namespace App\Routes;

use CodeIgniter\Router\RouteCollection;

class ChargesRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Charges */
        $routes->get("charges", "Api\Finances\Charges\Get\GetController::handle",  $this->optionsWithAuthentications);
        $routes->get("charges/(:num)", "Api\Finances\Charges\Get\GetController::handle/$1",  $this->optionsWithAuthentications);
        $routes->get("charges/preview", "Api\Finances\Charges\GetPreview\GetPreviewController::handle");

        $routes->get("charges/(:num)/extracts/(:num)", "Api\Finances\Charges\Extracts\Get\GetController::handle/$1/$2",  $this->optionsWithAuthentications);

        $routes->post("charges", "Api\Finances\Charges\Post\PostController::handle",  $this->optionsWithAuthentications);
        $routes->put("charges/(:num)", "Api\Finances\Charges\Put\PutController::handle/$1",  $this->optionsWithAuthentications);

        $routes->patch("charges/(:num)", "Api\Finances\Charges\Patch\PatchController::handle/$1",  $this->optionsWithAuthentications);
        $routes->delete("charges/(:num)", "Api\Finances\Charges\Delete\DeleteController::handle/$1",  $this->optionsWithAuthentications);

        $routes->post("charges/clients", "Api\Finances\Charges\Clients\Post\PostController::handle",  $this->optionsWithAuthentications);
    }
}
