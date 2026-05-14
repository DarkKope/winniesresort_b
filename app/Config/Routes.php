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

// Customer Routes
$routes->get('/', 'CustomerController::dashboard');
$routes->get('/dashboard', 'CustomerController::dashboard');
$routes->get('/book/(:num)', 'CustomerController::createBooking/$1');
$routes->post('/save-booking', 'CustomerController::saveBooking');
$routes->get('/my-bookings', 'CustomerController::myBookings');
$routes->get('/cancel-booking/(:num)', 'CustomerController::cancelBooking/$1');
$routes->get('/my-account', 'CustomerController::myAccount');
$routes->post('/update-account', 'CustomerController::updateAccount');
$routes->get('/change-password', 'CustomerController::changePassword');
$routes->post('/update-password', 'CustomerController::updatePassword');

// Auth Routes
$routes->get('/login', 'AuthController::login');
$routes->post('/doLogin', 'AuthController::doLogin');
$routes->get('/register', 'AuthController::register');
$routes->post('/doRegister', 'AuthController::doRegister');
$routes->get('/logout', 'AuthController::logout');

// Admin Routes
$routes->get('/admin/dashboard', 'AdminController::dashboard');
$routes->get('/admin/cottages', 'AdminController::cottages');
$routes->get('/admin/add-cottage', 'AdminController::addCottage');
$routes->post('/admin/save-cottage', 'AdminController::saveCottage');
$routes->get('/admin/edit-cottage/(:num)', 'AdminController::editCottage/$1');
$routes->post('/admin/update-cottage/(:num)', 'AdminController::updateCottage/$1');
$routes->get('/admin/delete-cottage/(:num)', 'AdminController::deleteCottage/$1');
$routes->get('/admin/bookings', 'AdminController::bookings');
$routes->get('/admin/view-booking/(:num)', 'AdminController::viewBooking/$1');
$routes->post('/admin/update-booking-status', 'AdminController::updateBookingStatus');
$routes->get('/admin/users', 'AdminController::users');
$routes->get('/admin/verify-payment/(:num)', 'AdminController::verifyPayment/$1');