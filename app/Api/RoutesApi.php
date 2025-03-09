<?php

namespace App\Api;

use CodeIgniter\Router\RouteCollection;

class RoutesApi
{

  public function init(RouteCollection $routes)
  {
    /** Authentications */
    $routes->post("auth", "Api\Authentications\Auth\PostController::handle");
    $routes->post("remember-me", "Api\Authentications\RememberMe\PostController::handle");

    /** Authentications */
    $routes->get("users", "Api\Users\Get\GetController::handle", ["filter" => "bearerToken"]);

    return $routes;
  }
}
