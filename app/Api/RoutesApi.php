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

    /** Recover */
    $routes->post("recover/password", "Api\Recover\Password\Post\PostController::handle");
    $routes->put("recover/password", "Api\Recover\Password\Put\PutController::handle");

    /** Users */
    $routes->get("users", "Api\Users\Get\GetController::handle", $this->optionsWithAuthentications);
    $routes->post("users", "Api\Users\Post\PostController::handle");
    $routes->put("users/(:num)", "Api\Users\Put\PutController::handle/$1", $this->optionsWithAuthentications);
    $routes->delete("users/(:num)", "Api\Users\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
    $routes->patch("users/(:num)", "Api\Users\Patch\PatchController::handle/$1");
    $routes->post("users/groups", "Api\Users\Groups\Post\PostController::handle", $this->optionsWithAuthentications);
    $routes->put("users/groups/(:num)", "Api\Users\Groups\Put\PutController::handle/$1", $this->optionsWithAuthentications);
    $routes->delete("users/groups/(:num)", "Api\Users\Groups\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
    $routes->patch("users/groups/(:num)", "Api\Users\Groups\Patch\PatchController::handle/$1", $this->optionsWithAuthentications);
    $routes->get("users/groups", "Api\Users\Groups\Get\GetController::handle", $this->optionsWithAuthentications);

    $routes->get("users/(:num)/notifications/(:num)", "Api\Users\Notifications\Get\GetController::handle/$1/$2", $this->optionsWithAuthentications);
    $routes->get("users/(:num)/notifications", "Api\Users\Notifications\Get\GetController::handle/$1", $this->optionsWithAuthentications);

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
    $routes->post("clients/(:num)/fields", "Api\Clients\Fields\Post\PostController::handle/$1", $this->optionsWithAuthentications);
    $routes->put("clients/(:num)", "Api\Clients\Put\PutController::handle/$1", $this->optionsWithAuthentications);

    $routes->get("clients/dispatchers", "Api\Clients\Dispatchers\Get\GetController::handle", $this->optionsWithAuthentications);
    $routes->get("clients/dispatchers/(:num)", "Api\Clients\Dispatchers\Get\GetController::handle/$1", $this->optionsWithAuthentications);

    $routes->get("clients/fields", "Api\Clients\Fields\Get\GetController::handle", $this->optionsWithAuthentications);
    $routes->get("clients/(:num)/fields", "Api\Clients\Fields\Get\GetController::handle/$1", $this->optionsWithAuthentications);
    $routes->get("clients/preview", "Api\Clients\GetPreview\GetPreviewController::handle", $this->optionsWithAuthentications);

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
    $routes->delete("custom-forms/(:num)", "Api\CustomForms\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);

    /** Forms */
    $routes->get("forms/(:num)", "Api\Forms\Get\GetController::handle/$1");
    $routes->get("forms", "Api\Forms\Get\GetController::handle");
    $routes->post("forms", "Api\Forms\Post\PostController::handle");

    $routes->get("forms/(:num)/fills", "Api\Forms\Fills\Get\GetController::handle/$1", $this->optionsWithAuthentications);
    $routes->get("forms/(:num)/fills/(:segment)", "Api\Forms\Fills\Get\GetController::handle/$1/$2", $this->optionsWithAuthentications);
    $routes->delete("forms/(:num)/fills/(:segment)", "Api\Forms\Fills\Delete\DeleteController::handle/$1/$2", $this->optionsWithAuthentications);

    /** Services */
    $routes->get("services", "Api\Services\Get\GetController::handle", $this->optionsWithAuthentications);
    $routes->get("services/(:num)", "Api\Services\Get\GetController::handle/$1", $this->optionsWithAuthentications);
    $routes->get("services/preview", "Api\Services\GetPreview\GetPreviewController::handle");

    $routes->post("services", "Api\Services\Post\PostController::handle", $this->optionsWithAuthentications);
    $routes->put("services/(:num)", "Api\Services\Put\PutController::handle/$1", $this->optionsWithAuthentications);
    $routes->delete("services/(:num)", "Api\Services\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);

    /** Fields */
    $routes->get("fields/groups", "Api\Fields\Groups\Get\GetController::handle", $this->optionsWithAuthentications);
    $routes->get("fields/(:num)/groups", "Api\Fields\Groups\Get\GetController::handle/$1", $this->optionsWithAuthentications);
    $routes->get("fields/(:num)/groups/(:num)", "Api\Fields\Groups\Get\GetController::handle/$1/$2", $this->optionsWithAuthentications);
    $routes->get("fields/groups/(:num)", "Api\Fields\Groups\Get\GetController::handle/$2/$1", $this->optionsWithAuthentications);

    $routes->post("fields", "Api\Fields\Post\PostController::handle",  $this->optionsWithAuthentications);

    $routes->delete("fields/(:num)", "Api\Fields\Delete\DeleteController::handle/$1",  $this->optionsWithAuthentications);

    /** Integrations */
    $routes->post("integrations", "Api\Integrations\Post\PostController::handle",  $this->optionsWithAuthentications);
    $routes->get("integrations", "Api\Integrations\Get\GetController::handle", $this->optionsWithAuthentications);
    $routes->get("integrations/(:num)", "Api\Integrations\Get\GetController::handle/$1", $this->optionsWithAuthentications);

    /** Charges */
    $routes->get("charges", "Api\Finances\Charges\Get\GetController::handle",  $this->optionsWithAuthentications);
    $routes->get("charges/(:num)", "Api\Finances\Charges\Get\GetController::handle/$1",  $this->optionsWithAuthentications);
    $routes->get("charges/preview", "Api\Finances\Charges\GetPreview\GetPreviewController::handle");

    $routes->get("charges/(:num)/extracts/(:num)", "Api\Finances\Charges\Extracts\Get\GetController::handle/$1/$2",  $this->optionsWithAuthentications);

    $routes->post("charges", "Api\Finances\Charges\Post\PostController::handle",  $this->optionsWithAuthentications);
    $routes->put("charges/(:num)", "Api\Finances\Charges\Put\PutController::handle/$1",  $this->optionsWithAuthentications);

    $routes->patch("charges/(:num)", "Api\Finances\Charges\Patch\PatchController::handle/$1",  $this->optionsWithAuthentications);
    $routes->delete("charges/(:num)", "Api\Finances\Charges\Delete\DeleteController::handle/$1",  $this->optionsWithAuthentications);

    $routes->post("charges/clients", "Api\Finances\Charges\Clients\Post\PostController::handle",  $this->optionsWithAuthentications);

    /** Payments */
    $routes->get("payments", "Api\Finances\Payments\Get\GetController::handle",  $this->optionsWithAuthentications);
    $routes->get("payments/(:num)", "Api\Finances\Payments\Get\GetController::handle/$1",  $this->optionsWithAuthentications);

    /** Operations */
    $routes->get("operations-failures", "Api\Finances\OperationsFailures\Get\GetController::handle",  $this->optionsWithAuthentications);
    $routes->get("operations-failures/(:num)", "Api\Finances\OperationsFailures\Get\GetController::handle/$1",  $this->optionsWithAuthentications);
    $routes->post("operations-failures/(:num)", "Api\Finances\OperationsFailures\Post\PostController::handle/$1",  $this->optionsWithAuthentications);

    /** Checkout */
    $routes->post("checkout", "Api\Finances\Checkout\Post\PostController::handle");

    /** Schedule */
    $routes->post("schedules", "Api\Schedules\Post\PostController::handle");
    $routes->get("schedules", "Api\Schedules\Get\GetController::handle",  $this->optionsWithAuthentications);
    $routes->get("schedules/(:num)", "Api\Schedules\Get\GetController::handle/$1",  $this->optionsWithAuthentications);
    $routes->put("schedules/(:num)", "Api\Schedules\Put\PutController::handle/$1",  $this->optionsWithAuthentications);
    $routes->delete("schedules/(:num)", "Api\Schedules\Delete\DeleteController::handle/$1",  $this->optionsWithAuthentications);

    /** MessagesDispatcher */
    $routes->delete("dispatcher/(:num)", "Api\MessagesDispatcher\Delete\DeleteController::handle/$1", $this->optionsWithAuthentications);
    $routes->post("dispatcher", "Api\MessagesDispatcher\Post\PostController::handle", $this->optionsWithAuthentications);
    $routes->get("dispatcher", "Api\MessagesDispatcher\Get\GetController::handle",  $this->optionsWithAuthentications);
    $routes->get("dispatcher/(:num)", "Api\MessagesDispatcher\Get\GetController::handle/$1",  $this->optionsWithAuthentications);
    $routes->put("dispatcher/(:num)", "Api\MessagesDispatcher\Put\PutController::handle/$1",  $this->optionsWithAuthentications);

    /** Webhooks */
    $routes->post("webhook/mercado-pago", "Api\WebHooks\MercadoPago\Post\PostController::handle");

    $routes->post("webhook/tasks/dispatcher", "Api\WebHooks\Tasks\Dispatcher\Post\PostController::handle");
    $routes->post("webhook/tasks/charge", "Api\WebHooks\Tasks\Charge\Post\PostController::handle");

    $routes->get("webhook/meta", "Api\WebHooks\Meta\Get\GetController::handle");

    $routes->get("webhook/meta", "Api\WebHooks\Meta\Get\GetController::handle");

    $routes->post("webhook/whatsapp", "Api\WebHooks\WhatsApp\Post\PostController::handle");
    $routes->get("webhook/whatsapp", "Api\WebHooks\WhatsApp\Get\GetController::handle");

    /** Notifications */
    $routes->get("notifications", "Api\Notifications\Get\GetController::handle");

    return $routes;
  }
}
