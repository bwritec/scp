<?php

    use CodeIgniter\Router\RouteCollection;


    /**
     * @var RouteCollection $routes
     */

    /**
     * /
     * /blank
     */
    $routes->get('/', 'HomeController::index');
    $routes->get('/blank', 'HomeController::blank');

    /**
     * Favorites
     */
    $routes->post('/favorites/add',    'FavoriteController::add');
    $routes->post('/favorites/remove', 'FavoriteController::remove');

    /**
     * /register
     */
    $routes->get('/register', 'RegisterController::index');
    $routes->post('/register', 'RegisterController::store');

    /**
     * /login
     * /logout
     */
    $routes->get('/login', 'LoginController::index');
    $routes->post('/login', 'LoginController::auth');
    $routes->get('/logout', 'LoginController::logout');

    /**
     * /forgot
     * /reset
     */
    $routes->get('/forgot', 'PasswordController::forgot');
    $routes->post('/forgot', 'PasswordController::sendResetLink');
    $routes->get('/reset/(:segment)', 'PasswordController::reset/$1');
    $routes->post('/reset-password', 'PasswordController::updatePassword');

    /**
     * /dashboard
     */
    $routes->get('/dashboard', 'DashboardController::index');

    /**
     * /dashboard/favorites
     */
    $routes->get('/dashboard/favorites',  'FavoriteController::list');

    /**
     * /dashboard/address
     */
    $routes->get('/dashboard/address', 'AddressController::index');
    $routes->post('/dashboard/address', 'AddressController::save');

    /**
     * /dashboard/contact
     */
    $routes->get('/dashboard/contact', 'PhoneController::index');
    $routes->post('/dashboard/contact', 'PhoneController::save');
