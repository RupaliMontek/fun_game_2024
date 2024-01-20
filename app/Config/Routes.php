<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'SuperAdmin::index');
// $routes->get('superadmin', 'SuperAdmin::index');
// $routes->get('superadmin/login', 'SuperAdmin::login');
// $routes->get('superadmin/dashboard', 'SuperAdmin::dashboard');
// $routes->get('superadmin/logout', 'SuperAdmin::logout');
// $routes->add('superadmin/register', 'SuperAdmin::register');
// $routes->add('superadmin/create_account', 'SuperAdmin::create_account');
// $routes->add('superadmin/login_as/(:num)', 'SuperAdmin::login_as/$1');
// $routes->get('admin/dashboard', 'Admin::dashboard');
// $routes->match(['get', 'post'], 'superadmin/login', 'SuperAdmin::login');
// // $routes->post('superadmin/create_account_from_dashboard', 'SuperAdmin::create_account_from_dashboard');
// // app/Config/Routes.php
$routes->get('/', 'SuperAdmin::index');
$routes->get('superadmin', 'SuperAdmin::index');
$routes->add('superadmin/login', 'SuperAdmin::login');
$routes->get('superadmin/dashboard', 'SuperAdmin::dashboard');
$routes->get('superadmin/logout', 'SuperAdmin::logout');
$routes->add('superadmin/register', 'SuperAdmin::register');
$routes->add('superadmin/create_account', 'SuperAdmin::create_account');
$routes->get('superadmin/login_as/(:num)', 'SuperAdmin::login_as/$1');
$routes->get('admin/dashboard', 'Admin::dashboard');
$routes->post('superadmin/create_account_from_dashboard', 'SuperAdmin::create_account_from_dashboard');
$routes->post('admin/create_players_account', 'Admin::create_players_account');
$routes->get('superadmin/login_as/(:num)', 'SuperAdmin::login_as/$1');
// $route->get('superadmin/logout', 'SuperAdmin::logout');
$routes->get('superadmin/login_aslogin_as_user/(:num)', 'SuperAdmin::login_as_user/$1');
$routes->get('superadmin/user_dashboard', 'SuperAdmin::user_dashboard');
$routes->get('superadmin/home', 'SuperAdmin::create_account');
$routes->get('superadmin/user_dashboard', 'SuperAdmin::user_dashboard');
$routes->get('user/home', 'User::home');
$routes->get('superadmin/login_as_user/(:num)', 'SuperAdmin::login_as_user/$1');
$routes->get('superadmin/add_admin_user', 'Superadmin::add_admin_user');
$routes->get('admin/add_player', 'Admin::add_player');
$routes->get('superadmin/edit_admin_user/(:num)', 'Superadmin::edit_admin_user/$1');
$routes->get('admin/edit_player_details/(:num)', 'Admin::edit_player_details/$1');
$routes->post('superadmin/update_account_details_admin/(:num)', 'SuperAdmin::update_account_details_admin/$1');
$routes->post('admin/update_players_account_details/(:num)', 'Admin::update_players_account_details/$1');
$routes->get('superadmin/history', 'SuperAdmin::history');
$routes->get('superadmin/setting', 'SuperAdmin::setting');
$routes->get('superadmin/change_password', 'SuperAdmin::change_password');
$routes->get('profile', 'SuperAdmin::profile');
    $routes->post('update_profile', 'SuperAdmin::update_profile');
