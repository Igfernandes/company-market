<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;
use App\Api\BaseRoutes;
use App\Api\Operations\Clients\Categories\Delete\DeleteController as DeleteCategoryController;
use App\Api\Operations\Clients\Categories\Get\GetController as GetCategoryController;
use App\Api\Operations\Clients\Categories\Post\PostController as PostCategoryController;
use App\Api\Operations\Clients\Categories\Put\PutController as PutCategoryController;
use App\Api\Operations\Clients\Delete\DeleteController;
use App\Api\Operations\Clients\Get\GetController;
use App\Api\Operations\Clients\Patch\PatchController;
use App\Api\Operations\Clients\Post\PostController;
use App\Api\Operations\Clients\Put\PutController;
use App\Api\Operations\Clients\Trash\Delete\DeleteController as DeleteTrashController;
use App\Api\Operations\Clients\Trash\Get\GetController as GetTrashController;
use App\Api\Operations\Clients\Trash\Post\PostController as PostTrashController;

class ClientsRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Clients */
        $routes->get("clients", [GetController::class, "handle"], $this->optionsWithAuthentications);
        $routes->get("clients/(:num)", [GetController::class, "handle/$1"], $this->optionsWithAuthentications);
        $routes->post("clients", [PostController::class, "handle"], $this->optionsWithAuthentications);
        $routes->patch("clients", [PatchController::class, "handle"], $this->optionsWithAuthentications);
        $routes->patch("clients/(:num)", [PatchController::class, "handle/$1"], $this->optionsWithAuthentications);

        $routes->delete("clients/(:num)", [DeleteController::class, "handle/$1"], $this->optionsWithAuthentications);
        $routes->delete("clients", [DeleteController::class, "handle"], $this->optionsWithAuthentications);

        $routes->put("clients/(:num)", [PutController::class, "handle/$1"], $this->optionsWithAuthentications);
    
        $routes->get("clients/categories", [GetCategoryController::class, "handle"], $this->optionsWithAuthentications);
        $routes->post("clients/categories", [PostCategoryController::class, "handle"], $this->optionsWithAuthentications);
        $routes->delete("clients/categories/(:num)",  [DeleteCategoryController::class, "handle/$1"], $this->optionsWithAuthentications);
        $routes->put("clients/categories/(:num)", [PutCategoryController::class, "handle/$1"], $this->optionsWithAuthentications);

        $routes->delete("clients/trash/(:num)", [DeleteTrashController::class, "handle/$1"], $this->optionsWithAuthentications);
        $routes->get("clients/trash/(:num)", [GetTrashController::class, "handle/$1"], $this->optionsWithAuthentications);
        $routes->get("clients/trash", [GetTrashController::class, "handle"], $this->optionsWithAuthentications);
        $routes->post("clients/trash", [PostTrashController::class, "handle"], $this->optionsWithAuthentications);
    }
}
