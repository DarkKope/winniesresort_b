<?php

namespace Config;

$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('CustomerController');
$routes->setDefaultMethod('dashboard');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// Main Route
$routes->get('/', 'CustomerController::dashboard');
$routes->get('/dashboard', 'CustomerController::dashboard');

// Auth Routes (AJAX)
$routes->post('/ajax/login', 'AuthController::ajaxLogin');
$routes->post('/ajax/register', 'AuthController::ajaxRegister');
$routes->get('/logout', 'AuthController::logout');

// Customer Routes
$routes->get('/cottage/(:num)', 'CustomerController::viewCottage/$1');
$routes->get('/my-bookings', 'CustomerController::myBookings');
$routes->post('/save-booking', 'CustomerController::saveBooking');
$routes->get('/cancel-booking/(:num)', 'CustomerController::cancelBooking');
$routes->get('/my-account', 'CustomerController::myAccount');
$routes->post('/update-account', 'CustomerController::updateAccount');
$routes->get('/change-password', 'CustomerController::changePassword');
$routes->post('/update-password', 'CustomerController::updatePassword');

// Admin Routes
$routes->group('admin', function($routes) {
    $routes->get('/', 'AdminController::dashboard');
    $routes->get('/dashboard', 'AdminController::dashboard');
    $routes->get('/cottages', 'AdminController::cottages');
    $routes->get('/add-cottage', 'AdminController::addCottage');
    $routes->post('/save-cottage', 'AdminController::saveCottage');
    $routes->get('/edit-cottage/(:num)', 'AdminController::editCottage/$1');
    $routes->post('/update-cottage/(:num)', 'AdminController::updateCottage/$1');
    $routes->get('/delete-cottage/(:num)', 'AdminController::deleteCottage/$1');
    $routes->get('/bookings', 'AdminController::bookings');
    $routes->get('/view-booking/(:num)', 'AdminController::viewBooking/$1');
    $routes->post('/update-booking-status', 'AdminController::updateBookingStatus');
    $routes->get('/users', 'AdminController::users');
});