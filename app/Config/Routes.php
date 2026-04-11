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
