<?php

use App\Api\Routes;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Router\RouteCollection;

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Index');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
$routes->setAutoRoute(true);



/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Router Api
 * --------------------------------------------------------------------
 */

$routes->group("api", ['namespace' => 'App'], function ($routes) {
    $routesApi = new Routes();
    $routes = $routesApi->init($routes);
});

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Index::index');
$routes->get('login', 'Index::login');
$routes->get('logout', 'Index::logout');
$routes->get('forgot-password', 'Index::forgotPassword');
$routes->get('alter-password', 'Index::alterPassword');


/*
 * --------------------------------------------------------------------
 * 404 Definitions
 * --------------------------------------------------------------------
 */

$routes->set404Override(function () {
    $request = service('request');
    $uri = $request->getUri()->getPath();

    // Se a rota começar com "api/"
    if (strstr($uri, 'api') !== false) {
        return json_encode([
            'status' => 404,
            'error'  => 'Api.invalid.route',
            'path'   => '/' . $uri
        ]);;
    }

    // Caso contrário, retorna a view como resposta
    return service('response')
        ->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
        ->setBody(view('errors/html/error_404'));
});
