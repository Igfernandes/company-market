<?php

namespace App\Api;

use CodeIgniter\Router\RouteCollection;

class RoutesApi
{
  private array $optionsWithAuthentications = ["filter" => "bearerToken"];

  public function init(RouteCollection $routes)
  {
    /** Authentications */
    $routes->post("auth", "Api\Authentications\Auth\PostController::handle");
    $routes->post("remember-me", "Api\Authentications\RememberMe\PostController::handle");


    /** Users */
    $routes->get("users", "Api\Users\Get\GetController::handle", $this->optionsWithAuthentications);

    /** Clients */
    $routes->get("clients", "Api\Clients\Get\GetController::handle", $this->optionsWithAuthentications);

    return $routes;
  }
}
