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

    // /** Users */
    $routes->get("users", "Api\Users\Get\GetController::handle", $this->optionsWithAuthentications);
    $routes->post("users", "Api\Users\Post\PostController::handle");
    $routes->delete("users/(:num)", "Api\Users\Delete\DeleteController::handle/$1");
    $routes->patch("users/(:num)", "Api\Users\Patch\PatchController::handle/$1");
    $routes->post("users/groups", "Api\Users\Groups\Post\PostController::handle", $this->optionsWithAuthentications);
    $routes->put("users/groups/(:num)", "Api\Users\Groups\Put\PutController::handle/$1", $this->optionsWithAuthentications);
    $routes->delete("users/groups/(:num)", "Api\Users\Groups\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
    $routes->patch("users/groups/(:num)", "Api\Users\Groups\Patch\PatchController::handle/$1", $this->optionsWithAuthentications);
    $routes->get("users/groups", "Api\Users\Groups\Get\GetController::handle", $this->optionsWithAuthentications);

    /** Invites */
    $routes->post("invites/user", "Api\Invites\Users\Post\PostController::handle", $this->optionsWithAuthentications);
    $routes->post("invites/user/resend/(:num)", "Api\Invites\Users\Resend\PostController::handle/$1", $this->optionsWithAuthentications);
    $routes->delete("invites/user/resend/(:num)", "Api\Invites\Users\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
    $routes->get("invites/user", "Api\Invites\Users\Get\GetController::handle", $this->optionsWithAuthentications);
    $routes->get("invites/user/(:num)", "Api\Invites\Users\Get\GetController::handle", $this->optionsWithAuthentications);

    /** Clients */
    $routes->get("clients", "Api\Clients\Get\GetController::handle", $this->optionsWithAuthentications);
    $routes->post("clients", "Api\Clients\Post\PostController::handle", $this->optionsWithAuthentications);
    $routes->patch("clients", "Api\Clients\Patch\PatchController::handle", $this->optionsWithAuthentications);
    $routes->delete("clients/(:num)", "Api\Clients\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
    $routes->delete("clients", "Api\Clients\Delete\DeleteController::handle", $this->optionsWithAuthentications);

    $routes->get("clients/categories", "Api\Clients\Categories\Get\GetController::handle", $this->optionsWithAuthentications);
    $routes->post("clients/categories", "Api\Clients\Categories\Post\PostController::handle", $this->optionsWithAuthentications);

    /** Permissions */
    $routes->get("permissions", "Api\Permissions\Get\GetController::handle", $this->optionsWithAuthentications);
    $routes->get("permissions/groups", "Api\Permissions\Groups\Get\GetController::handle", $this->optionsWithAuthentications);
    $routes->get("permissions/groups/(:num)", "Api\Permissions\Groups\Get\GetController::handle/$1", $this->optionsWithAuthentications);

    /** CustomForms */
    $routes->get("custom-forms", "Api\CustomForms\Get\GetController::handle", $this->optionsWithAuthentications);
    $routes->get("custom-forms/(:num)", "Api\CustomForms\Get\GetController::handle/$1", $this->optionsWithAuthentications);
    $routes->post("custom-forms", "Api\CustomForms\Post\PostController::handle", $this->optionsWithAuthentications);
    $routes->put("custom-forms/(:num)", "Api\CustomForms\Put\PutController::handle/$1", $this->optionsWithAuthentications);

    /** Forms */
    $routes->get("forms/(:num)", "Api\Forms\Get\GetController::handle/$1");

    /** Services */
    $routes->get("services", "Api\Services\Get\GetController::handle", $this->optionsWithAuthentications);
    $routes->get("services/(:num)", "Api\Services\Get\GetController::handle/$1", $this->optionsWithAuthentications);
    $routes->post("services", "Api\Services\Post\PostController::handle", $this->optionsWithAuthentications);
    $routes->put("services/(:num)", "Api\Services\Put\PutController::handle/$1", $this->optionsWithAuthentications);
    $routes->delete("services/(:num)", "Api\Services\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);

    return $routes;
  }
}
