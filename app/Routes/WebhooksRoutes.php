<?php

namespace App\Routes;

use CodeIgniter\Router\RouteCollection;

class WebhooksRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Webhooks */
        $routes->post("webhook/mercado-pago", "Api\WebHooks\MercadoPago\Post\PostController::handle");
        $routes->post("webhook/tasks/dispatcher", "Api\WebHooks\Tasks\Dispatcher\Post\PostController::handle");
        $routes->post("webhook/tasks/charge", "Api\WebHooks\Tasks\Charge\Post\PostController::handle");
        $routes->get("webhook/meta", "Api\WebHooks\Meta\Get\GetController::handle");
        $routes->get("webhook/meta", "Api\WebHooks\Meta\Get\GetController::handle");
        $routes->post("webhook/whatsapp", "Api\WebHooks\WhatsApp\Post\PostController::handle");
        $routes->get("webhook/whatsapp", "Api\WebHooks\WhatsApp\Get\GetController::handle");
    }
}
