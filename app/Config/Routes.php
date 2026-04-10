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
