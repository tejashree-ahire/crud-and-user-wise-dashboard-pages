<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Register::index');
$routes->get('register', 'Register::index');
$routes->post('register/store', 'Register::store');

$routes->get('/login', 'Register::login');
$routes->post('/login/auth', 'Register::auth');
$routes->get('/logout', 'Register::logout');

$routes->get('/dashboard/(:num)', 'Register::dashboard/$1', ['filter' => 'authguard']);
$routes->get('/admindashboard', 'Register::Admindashboard', ['filter' => 'authguard']);


$routes->get('/edit/(:num)', 'Register::edit/$1',['filter' => 'authguard']);
$routes->post('/update/(:num)', 'Register::update/$1'); 

// $routes->get('/clients', 'Register::index');
$routes->post('delete/(:num)', 'Register::delete/$1',['filter' => 'authguard']);
