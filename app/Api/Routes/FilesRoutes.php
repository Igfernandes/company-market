<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;
use App\Api\BaseRoutes;

class FilesRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Notifications */
        $routes->post("files", "Api\Operations\Files\Post\PostController::handle");
    }
}
