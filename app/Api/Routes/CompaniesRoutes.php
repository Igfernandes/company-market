<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;
use App\Api\BaseRoutes;
use App\Api\Operations\Companies\Delete\DeleteController;
use App\Api\Operations\Companies\Get\GetController;
use App\Api\Operations\Companies\Patch\PatchController;
use App\Api\Operations\Companies\Post\PostController;
use App\Api\Operations\Companies\Put\PutController;
use App\Api\Operations\Companies\Trash\Delete\DeleteController as DeleteTrashController;
use App\Api\Operations\Companies\Trash\Get\GetController as GetTrashController;
use App\Api\Operations\Companies\Trash\Post\PostController as PostTrashController;

class CompaniesRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Companies */
        $routes->get("companies", [GetController::class, "handle"], $this->optionsWithAuthentications);
        $routes->get("companies/(:num)", [GetController::class, "handle/$1"], $this->optionsWithAuthentications);
        $routes->post("companies", [PostController::class, "handle"], $this->optionsWithAuthentications);
        $routes->patch("companies", [PatchController::class, "handle"], $this->optionsWithAuthentications);
        $routes->patch("companies/(:num)", [PatchController::class, "handle/$1"], $this->optionsWithAuthentications);

        $routes->delete("companies/(:num)", [DeleteController::class, "handle/$1"], $this->optionsWithAuthentications);
        $routes->delete("companies", [DeleteController::class, "handle"], $this->optionsWithAuthentications);

        $routes->put("companies/(:num)", [PutController::class, "handle/$1"], $this->optionsWithAuthentications);
    
        $routes->delete("companies/trash/(:num)", [DeleteTrashController::class, "handle/$1"], $this->optionsWithAuthentications);
        $routes->get("companies/trash/(:num)", [GetTrashController::class, "handle/$1"], $this->optionsWithAuthentications);
        $routes->get("companies/trash", [GetTrashController::class, "handle"], $this->optionsWithAuthentications);
        $routes->post("companies/trash", [PostTrashController::class, "handle"], $this->optionsWithAuthentications);
    }
}
