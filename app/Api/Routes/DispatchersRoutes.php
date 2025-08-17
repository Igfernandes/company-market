<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;
use App\Api\BaseRoutes;

class DispatchersRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** MessagesDispatcher */
        $routes->delete("dispatchers/(:num)", "Api\Operations\Dispatchers\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
        $routes->post("dispatchers", "Api\Operations\Dispatchers\Post\PostController::handle", $this->optionsWithAuthentications);
        $routes->get("dispatchers", "Api\Operations\Dispatchers\Get\GetController::handle",  $this->optionsWithAuthentications);
        $routes->get("dispatchers/(:num)", "Api\Operations\Dispatchers\Get\GetController::handle/$1",  $this->optionsWithAuthentications);
        $routes->put("dispatchers/(:num)", "Api\Operations\Dispatchers\Put\PutController::handle/$1",  $this->optionsWithAuthentications);
    }
}
