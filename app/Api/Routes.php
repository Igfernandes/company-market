<?php

namespace App\Api;

use App\Api\Routes\AttemptsRoutes;
use App\Api\Routes\AuthenticationsRoutes;
use App\Api\Routes\ChargesRoutes;
use App\Api\Routes\CheckoutRoutes;
use App\Api\Routes\ClientsRoutes;
use App\Api\Routes\CompaniesRoutes;
use App\Api\Routes\CustomFormsRoutes;
use App\Api\Routes\DispatchersRoutes;
use App\Api\Routes\ExportsRoutes;
use App\Api\Routes\FieldsRoutes;
use App\Api\Routes\FilesRoutes;
use App\Api\Routes\FormsRoutes;
use App\Api\Routes\IntegrationsRoutes;
use App\Api\Routes\InvitesRoutes;
use App\Api\Routes\NotificationsRoutes;
use App\Api\Routes\OperationsFailuresRoutes;
use App\Api\Routes\PaymentsRoutes;
use App\Api\Routes\PermissionsRoutes;
use App\Api\Routes\RecoversRoutes;
use App\Api\Routes\SchedulesRoutes;
use App\Api\Routes\ServicesRoutes;
use App\Api\Routes\UsersRoutes;
use App\Api\Routes\WebhooksRoutes;
use CodeIgniter\Router\RouteCollection;

class Routes
{
  private $routesInstances = [
    AuthenticationsRoutes::class,
    ClientsRoutes::class,
    DispatchersRoutes::class,
    IntegrationsRoutes::class,
    InvitesRoutes::class,
    NotificationsRoutes::class,
    OperationsFailuresRoutes::class,
    PermissionsRoutes::class,
    RecoversRoutes::class,
    SchedulesRoutes::class,
    ServicesRoutes::class,
    UsersRoutes::class,
    WebhooksRoutes::class,
    ExportsRoutes::class,
    FilesRoutes::class,
    AttemptsRoutes::class,
    CompaniesRoutes::class
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
