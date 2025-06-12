<?php

namespace App\Routes;

use CodeIgniter\Router\RouteCollection;

class UsersRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        $routes->get("users", "Api\Users\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->post("users", "Api\Users\Post\PostController::handle");
        $routes->put("users/(:num)", "Api\Users\Put\PutController::handle/$1", $this->optionsWithAuthentications);
        $routes->delete("users/(:num)", "Api\Users\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
        $routes->patch("users/(:num)", "Api\Users\Patch\PatchController::handle/$1");
        $routes->post("users/groups", "Api\Users\Groups\Post\PostController::handle", $this->optionsWithAuthentications);
        $routes->put("users/groups/(:num)", "Api\Users\Groups\Put\PutController::handle/$1", $this->optionsWithAuthentications);
        $routes->delete("users/groups/(:num)", "Api\Users\Groups\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
        $routes->patch("users/groups/(:num)", "Api\Users\Groups\Patch\PatchController::handle/$1", $this->optionsWithAuthentications);
        $routes->get("users/groups", "Api\Users\Groups\Get\GetController::handle", $this->optionsWithAuthentications);

        $routes->get("users/(:num)/notifications/(:num)", "Api\Users\Notifications\Get\GetController::handle/$1/$2", $this->optionsWithAuthentications);
        $routes->get("users/(:num)/notifications", "Api\Users\Notifications\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->post("users/notifications", "Api\Users\Notifications\Post\PostController::handle", $this->optionsWithAuthentications);
    }
}
