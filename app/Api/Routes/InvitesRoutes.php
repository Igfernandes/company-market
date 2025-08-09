<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class InvitesRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Invites */
        $routes->post("invites/user", "Api\Invites\Users\Post\PostController::handle", $this->optionsWithAuthentications);
        $routes->post("invites/user/resend/(:num)", "Api\Invites\Users\Resend\PostController::handle/$1", $this->optionsWithAuthentications);
        $routes->delete("invites/(:num)/user", "Api\Invites\Users\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
        $routes->get("invites/user", "Api\Invites\Users\Get\GetController::handle", $this->optionsWithAuthentications);
        $routes->get("invites/user/(:num)", "Api\Invites\Users\Get\GetController::handle", $this->optionsWithAuthentications);
    }
}
