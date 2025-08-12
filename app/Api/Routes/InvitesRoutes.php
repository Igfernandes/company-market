<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class InvitesRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Invites */
        $routes->post("invites/user", "Api\Operations\Invites\Users\Post\PostController::handle", $this->optionsWithAuthentications);
        $routes->post("invites/user/resend/(:num)", "Api\Operations\Invites\Users\Resend\PostController::handle/$1", $this->optionsWithAuthentications);
        $routes->delete("invites/(:num)/user", "Api\Operations\Invites\Users\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
        $routes->get("invites/user", "Api\Operations\Invites\Users\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("invites/user/(:num)", "Api\Operations\Invites\Users\Get\GetController::handle", $this->optionsWithAuthentications);
    }
}
