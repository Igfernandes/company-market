<?php

use App\Api\Routes\Routes;
use CodeIgniter\Router\RouteCollection;

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
$routes->get('forgot-password', 'Index::forgotPassword');
$routes->get('alter-password', 'Index::alterPassword');