<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index');

$routes->post('login/authenticate', 'Login::authenticate');
$routes->get('signup', 'Login::signup');
$routes->post('signup/register', 'Login::register');
$routes->get('login/logout', 'Login::logout');

$routes->get('home', 'Home::index');
$routes->get('home/profile', 'Home::profile');
$routes->get('logout', 'Home::logout');

// ROAD FOR UPDATING USERNAME
$routes->post('home/update', 'Home::updateAccount');

// ROAD FOR DELETING ACCOUNT
$routes->post('home/delete', 'Home::deleteAccount');

// --- USER CRUD ROUTES ---
$routes->get('home/edit/(:num)', 'Home::editUser/$1');
$routes->post('home/save_update/(:num)', 'Home::saveUserUpdate/$1');
$routes->get('home/delete_user/(:num)', 'Home::deleteUser/$1');

// --- USER LIST & ADD USER ---
$routes->get('home/userList', 'Home::userList');
$routes->get('home/addUser', 'Home::addUser');
$routes->post('home/saveUser', 'Home::saveUser');

$routes->get('admin/agent_tickets', 'Support::manageTickets');
$routes->get('admin/user_support', 'Support::userSupport');
$routes->get('admin/support_create', 'Home::viewTemplate/support_ticket');
$routes->get('admin/support_edit/(:num)', 'Support::editTicket/$1');
$routes->get('admin/(:any)', 'Home::viewTemplate/$1');

// --- SUPPORT TICKET SYSTEM ROUTES ---
$routes->post('admin/submitTicket', 'Support::submitTicket');
$routes->post('home/submitTicket', 'Support::submitTicket');
$routes->post('support/updateStatus/(:num)', 'Support::updateTicketStatus/$1');
$routes->post('support/updateDescription/(:num)', 'Support::updateDescription/$1');
$routes->post('support/updateFullTicket/(:num)', 'Support::updateFullTicket/$1');
$routes->get('support/getTicket/(:num)', 'Support::getTicketDetails/$1');
$routes->get('support/deleteTicket/(:num)', 'Support::deleteTicket/$1');
$routes->get('support/getHistory/(:num)', 'Support::getHistory/$1');

// --- NEW DATA TABLE ROUTE ---
$routes->get('admin/student-data', 'StudentData::index');
$routes->post('admin/graphql', 'GraphQL::index');

// --- MEDIA SERVING ROUTE ---
$routes->get('media/view/(:any)', 'Media::view/$1');
