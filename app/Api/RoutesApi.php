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
    $routes->post("clients", "Api\Clients\Post\PostController::handle", $this->optionsWithAuthentications);
    $routes->patch("clients", "Api\Clients\Patch\PatchController::handle", $this->optionsWithAuthentications);
    $routes->delete("clients/(:num)?", "Api\Clients\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
    $routes->delete("clients", "Api\Clients\Delete\DeleteController::handle", $this->optionsWithAuthentications);

    $routes->get("clients/categories", "Api\Clients\Categories\Get\GetController::handle", $this->optionsWithAuthentications);
    $routes->post("clients/categories", "Api\Clients\Categories\Post\PostController::handle", $this->optionsWithAuthentications);

    return $routes;
  }
}
