<?php

namespace App\Api;

use App\Routes\AuthenticationsRoutes;
use App\Routes\ChargesRoutes;
use App\Routes\CheckoutRoutes;
use App\Routes\ClientsRoutes;
use App\Routes\CustomFormsRoutes;
use App\Routes\DispatchersRoutes;
use App\Routes\ExportsRoutes;
use App\Routes\FieldsRoutes;
use App\Routes\FilesRoutes;
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
  private $routesInstances = [
    AuthenticationsRoutes::class,
    ChargesRoutes::class,
    CheckoutRoutes::class,
    ClientsRoutes::class,
    CustomFormsRoutes::class,
    DispatchersRoutes::class,
    FieldsRoutes::class,
    FormsRoutes::class,
    IntegrationsRoutes::class,
    InvitesRoutes::class,
    NotificationsRoutes::class,
    OperationsFailuresRoutes::class,
    PaymentsRoutes::class,
    PermissionsRoutes::class,
    RecoversRoutes::class,
    SchedulesRoutes::class,
    ServicesRoutes::class,
    UsersRoutes::class,
    WebhooksRoutes::class,
    ExportsRoutes::class,
    FilesRoutes::class
  ];
  public function init(RouteCollection $routes)
  {
    foreach ($this->routesInstances as $instance) {
      $routeClass = new $instance();
      $routeClass->load($routes);
    }
    return $routes;
  }
}
