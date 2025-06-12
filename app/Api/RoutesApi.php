<?php

namespace App\Api;

use App\Routes\AuthenticationsRoutes;
use App\Routes\ChargesRoutes;
use App\Routes\CheckoutRoutes;
use App\Routes\ClientsRoutes;
use App\Routes\CustomFormsRoutes;
use App\Routes\DispatchersRoutes;
use App\Routes\FieldsRoutes;
use App\Routes\FormsRoutes;
use App\Routes\IntegrationsRoutes;
use App\Routes\InvitesRoutes;
use App\Routes\NotificationsRoutes;
use App\Routes\OperationsFailuresRoutes;
use App\Routes\PaymentsRoutes;
use App\Routes\PermissionsRoutes;
use App\Routes\RecoversRoutes;
use App\Routes\SchedulesRoutes;
use App\Routes\ServicesRoutes;
use App\Routes\UsersRoutes;
use App\Routes\WebhooksRoutes;
use CodeIgniter\Router\RouteCollection;

class RoutesApi
{
  public function init(RouteCollection $routes)
  {
    $authentications = new AuthenticationsRoutes();
    $authentications->load($routes);

    $charges = new ChargesRoutes();
    $charges->load($routes);

    $checkout = new CheckoutRoutes();
    $checkout->load($routes);

    $clients = new ClientsRoutes();
    $clients->load($routes);

    $customForms = new CustomFormsRoutes();
    $customForms->load($routes);

    $dispatchers = new DispatchersRoutes();
    $dispatchers->load($routes);

    $fields = new FieldsRoutes();
    $fields->load($routes);

    $forms = new FormsRoutes();
    $forms->load($routes);

    $integrations = new IntegrationsRoutes();
    $integrations->load($routes);

    $invites = new InvitesRoutes();
    $invites->load($routes);

    $notifications = new NotificationsRoutes();
    $notifications->load($routes);

    $operationsFailures = new OperationsFailuresRoutes();
    $operationsFailures->load($routes);

    $payments = new PaymentsRoutes();
    $payments->load($routes);

    $permissions = new PermissionsRoutes();
    $permissions->load($routes);

    $recovers = new RecoversRoutes();
    $recovers->load($routes);

    $schedules = new SchedulesRoutes();
    $schedules->load($routes);

    $services = new ServicesRoutes();
    $services->load($routes);

    $users = new UsersRoutes();
    $users->load($routes);

    $webhooks = new WebhooksRoutes();
    $webhooks->load($routes);

    return $routes;
  }
}
