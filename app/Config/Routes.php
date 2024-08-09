<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::index');
$routes->post('authorize', 'UserController::authorize');
$routes->get('dashboard', 'UserController::dashboard');
$routes->get('logout', 'UserController::logout');