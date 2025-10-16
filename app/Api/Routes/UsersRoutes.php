<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;
use App\Api\BaseRoutes;

class UsersRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        $routes->get("users", "Api\Operations\Users\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->post("users", "Api\Operations\Users\Post\PostController::handle");
        $routes->put("users", "Api\Operations\Users\Put\PutController::handle", $this->optionsWithAuthentications);
        $routes->put("users/(:num)", "Api\Operations\Users\Put\PutController::handle/$1", $this->optionsWithAuthentications);
        $routes->delete("users/(:num)", "Api\Operations\Users\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
        $routes->patch("users/(:num)", "Api\Operations\Users\Patch\PatchController::handle/$1");
        $routes->post("users/(:num)/permissions", "Api\Operations\Users\Permissions\Post\PostController::handle/$1", $this->optionsWithAuthentications);

        $routes->delete("users/trash/(:num)", "Api\Operations\Users\Trash\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
        $routes->get("users/trash/(:num)", "Api\Operations\Users\Trash\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->get("users/trash", "Api\Operations\Users\Trash\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->post("users/trash", "Api\Operations\Users\Trash\Post\PostController::handle", $this->optionsWithAuthentications);

        $routes->get("users/roles", "Api\Operations\Users\Roles\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->post("users/roles", "Api\Operations\Users\Roles\Post\PostController::handle", $this->optionsWithAuthentications);
        $routes->put("users/roles/(:num)", "Api\Operations\Users\Roles\Put\PutController::handle/$1", $this->optionsWithAuthentications);
        $routes->delete("users/roles/(:num)", "Api\Operations\Users\Roles\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);

        $routes->get("users/roles/(:num)/permissions", "Api\Operations\Users\Roles\Permissions\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->post("users/roles/(:num)/permissions", "Api\Operations\Users\Roles\Permissions\Post\PostController::handle/$1", $this->optionsWithAuthentications);

        $routes->get("users/(:num)/notifications/(:num)", "Api\Operations\Users\Notifications\Get\GetController::handle/$1/$2", $this->optionsWithAuthentications);
        $routes->get("users/(:num)/notifications", "Api\Operations\Users\Notifications\Get\GetController::handle/$1", $this->optionsWithAuthentications);
        $routes->post("users/notifications", "Api\Operations\Users\Notifications\Post\PostController::handle", $this->optionsWithAuthentications);
    }
}
