<?php

namespace App\Api;

use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Router\RouteCollection;

class RoutesApi
{

  public function init(RouteCollection $routes)
  {
    /** Authentications */
    $routes->post("authentications/social", "Api\Authentications\Social\PostController::handle");

    /** Users */
    $routes->patch("users", "Api\Users\Patch\PatchController::handle");
    $routes->post("users/(:alpha)/data/", "Api\Users\Data\Post\PostController::handle/$1");
    $routes->post("users/photo", "Api\Users\Photo\PostController::handle");
    $routes->get("users/(:num)", "Api\Users\Get\GetController::handle/$1");
    $routes->get("users/", "Api\Users\Get\GetController::handle");

    /** Companies */
    $routes->post("companies/(:alpha)/data/", "Api\Companies\Data\Post\PostController::handle/$1");

    /** Tokens */
    $routes->post("tokens/confirm-email", "Api\Tokens\ConfirmEmail\Post\PostController::handle");
    $routes->get("tokens/confirm-email", "Api\Tokens\ConfirmEmail\Get\GetController::handle");

    /** CustomFields */
    $routes->post("custom-forms", "Api\CustomForms\Post\PostController::handle");
    $routes->get("custom-forms", "Api\CustomForms\Get\GetController::handle");
    $routes->get("custom-forms/(:num)", "Api\CustomForms\Get\GetController::handle/$1");

    return $routes;
  }
}
