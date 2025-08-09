<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class DispatchersRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** MessagesDispatcher */
        $routes->delete("dispatchers/(:num)", "Api\Dispatchers\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
        $routes->post("dispatchers", "Api\Dispatchers\Post\PostController::handle", $this->optionsWithAuthentications);
        $routes->get("dispatchers", "Api\Dispatchers\Get\GetController::handle",  $this->optionsWithAuthentications);
        $routes->get("dispatchers/(:num)", "Api\Dispatchers\Get\GetController::handle/$1",  $this->optionsWithAuthentications);
        $routes->put("dispatchers/(:num)", "Api\Dispatchers\Put\PutController::handle/$1",  $this->optionsWithAuthentications);
    }
}
