<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;
use App\Api\BaseRoutes;
use App\Api\Operations\Files\Post\PostController;

class FilesRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Notifications */
        $routes->post("files", [PostController::class, "handle"]);
    }
}
