<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/graphview/(:num)', 'Home::graphview/$1');
$routes->post('save-answer', 'Home::saveAnswer');
$routes->get('identify-image/(:num)', 'Quiz::identifyImage/$1');

$routes->get('/admin', 'Admin::index');
$routes->post('login', 'Admin::login');
$routes->get('admin/dashboard', 'Admin::dashboard');


// Dynamic routes (corrected)
$routes->post('(:any)', 'Admin::$1');
$routes->post('(:any)/(:num)/(:num)', 'Admin::$1/$2/$3');

$routes->get('(:any)/(:num)', 'Admin::$1/$2');
$routes->get('(:any)', 'Admin::$1');  



