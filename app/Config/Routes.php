<?php

use App\Api\Routes;
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
