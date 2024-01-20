<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'login::index');
$routes->get('superadmin', 'SuperAdmin::index');
$routes->add('superadmin/login', 'SuperAdmin::login');
$routes->get('superadmin/admin_user_list', 'SuperAdmin::admin_user_list');
$routes->get('superadmin/logout', 'SuperAdmin::logout');
$routes->add('superadmin/register', 'SuperAdmin::register');
$routes->add('superadmin/create_account', 'SuperAdmin::create_account');
$routes->get('superadmin/login_as/(:num)', 'SuperAdmin::login_as/$1');
$routes->get('admin/players_list', 'Admin::players_list');
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
$routes->post('admin/check_player_username_exist', 'Admin::check_player_username_exist');
$routes->post('login/check_login', 'Login::check_login');
$routes->get('admin/check_player_username_exist', 'Admin::check_player_username_exist');
$routes->get('admin', 'Admin::index');
$routes->get('login', 'Login::index');
$routes->post('login/users_status_change', 'Login::users_status_change');
$routes->get('logout', 'Login::logout');
$routes->get('superadmin', 'Superadmin::index');




