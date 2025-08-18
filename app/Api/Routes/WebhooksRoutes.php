<?php

namespace App\Api\Routes;

use CodeIgniter\Router\RouteCollection;
use App\Api\BaseRoutes;

class WebhooksRoutes extends BaseRoutes
{
    public function load(RouteCollection &$routes)
    {
        /** Webhooks */
        $routes->post("webhook/mercado-pago", "Api\Operations\Webhooks\MercadoPago\Post\PostController::handle");
        $routes->post("webhook/tasks/dispatcher", "Api\Operations\Webhooks\Tasks\Dispatcher\Post\PostController::handle");
        $routes->post("webhook/tasks/charge", "Api\Operations\Webhooks\Tasks\Charge\Post\PostController::handle");
        $routes->get("webhook/meta", "Api\Operations\Webhooks\Meta\Get\GetController::handle");
        
        $routes->post("webhook/whatsapp", "Api\Operations\Webhooks\WhatsApp\Post\PostController::handle");
        $routes->get("webhook/whatsapp", "Api\Operations\Webhooks\WhatsApp\Get\GetController::handle");
    }
}
