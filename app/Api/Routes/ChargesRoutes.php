<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;
use App\Api\BaseRoutes;

class ChargesRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Charges */
        $routes->get("charges", "Api\Operations\Finances\Charges\Get\GetController::handle",  $this->optionsWithAuthentications);
        $routes->get("charges/(:num)", "Api\Operations\Finances\Charges\Get\GetController::handle/$1",  $this->optionsWithAuthentications);
        $routes->get("charges/preview", "Api\Operations\Finances\Charges\GetPreview\GetPreviewController::handle");

        $routes->get("charges/(:num)/extracts/(:num)", "Api\Operations\Finances\Charges\Extracts\Get\GetController::handle/$1/$2",  $this->optionsWithAuthentications);

        $routes->post("charges", "Api\Operations\Finances\Charges\Post\PostController::handle",  $this->optionsWithAuthentications);
        $routes->put("charges/(:num)", "Api\Operations\Finances\Charges\Put\PutController::handle/$1",  $this->optionsWithAuthentications);

        $routes->patch("charges/(:num)", "Api\Operations\Finances\Charges\Patch\PatchController::handle/$1",  $this->optionsWithAuthentications);
        $routes->delete("charges/(:num)", "Api\Operations\Finances\Charges\Delete\DeleteController::handle/$1",  $this->optionsWithAuthentications);

        $routes->post("charges/clients", "Api\Operations\Finances\Charges\Clients\Post\PostController::handle",  $this->optionsWithAuthentications);
    }
}
