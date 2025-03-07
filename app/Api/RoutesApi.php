<?php

namespace App\Api;

use CodeIgniter\Router\RouteCollection;

class RoutesApi
{

  public function init(RouteCollection $routes)
  {
    /** Authentications */
    $routes->post("auth", "Api\Authentications\Auth\PostController::handle");



    return $routes;
  }
}
