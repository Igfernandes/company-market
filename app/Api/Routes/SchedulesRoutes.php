<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class SchedulesRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Schedule */
        $routes->post("schedules", "Api\Operations\Schedules\Post\PostController::handle", $this->optionsWithAuthentications);
        $routes->get("schedules", "Api\Operations\Schedules\Get\GetController::handle",  $this->optionsWithAuthentications);
        $routes->get("schedules/(:num)", "Api\Operations\Schedules\Get\GetController::handle/$1",  $this->optionsWithAuthentications);
        $routes->put("schedules/(:num)", "Api\Operations\Schedules\Put\PutController::handle/$1",  $this->optionsWithAuthentications);
        $routes->delete("schedules/(:num)", "Api\Operations\Schedules\Delete\DeleteController::handle/$1",  $this->optionsWithAuthentications);
    }
}
