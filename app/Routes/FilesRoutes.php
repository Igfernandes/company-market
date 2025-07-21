<?php

namespace App\Routes;

use CodeIgniter\Router\RouteCollection;

class FilesRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Notifications */
        $routes->post("files", "Api\Files\Post\PostController::handle");
    }
}
