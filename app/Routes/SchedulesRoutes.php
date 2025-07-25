<?php

namespace App\Routes;

use CodeIgniter\Router\RouteCollection;

class SchedulesRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Schedule */
        $routes->post("schedules", "Api\Schedules\Post\PostController::handle", $this->optionsWithAuthentications);
        $routes->get("schedules", "Api\Schedules\Get\GetController::handle",  $this->optionsWithAuthentications);
        $routes->get("schedules/(:num)", "Api\Schedules\Get\GetController::handle/$1",  $this->optionsWithAuthentications);
        $routes->put("schedules/(:num)", "Api\Schedules\Put\PutController::handle/$1",  $this->optionsWithAuthentications);
        $routes->delete("schedules/(:num)", "Api\Schedules\Delete\DeleteController::handle/$1",  $this->optionsWithAuthentications);
    }
}
