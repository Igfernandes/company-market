<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;

class WebhooksRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Webhooks */
        $routes->post("webhook/mercado-pago", "Api\Operations\WebHooks\MercadoPago\Post\PostController::handle");
        $routes->post("webhook/tasks/dispatcher", "Api\Operations\WebHooks\Tasks\Dispatcher\Post\PostController::handle");
        $routes->post("webhook/tasks/charge", "Api\Operations\WebHooks\Tasks\Charge\Post\PostController::handle");
        $routes->get("webhook/meta", "Api\Operations\WebHooks\Meta\Get\GetController::handle");
        
        $routes->post("webhook/whatsapp", "Api\Operations\WebHooks\WhatsApp\Post\PostController::handle");
        $routes->get("webhook/whatsapp", "Api\Operations\WebHooks\WhatsApp\Get\GetController::handle");
    }
}
