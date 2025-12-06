<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * API Routes
 * --------------------------------------------------------------------
 */
$routes->group('api', ['namespace' => 'App\Controllers'], function($routes) {
    // Authentication Routes
    $routes->post('register', 'AuthController::register');
    $routes->post('login', 'AuthController::login');
    
    // Inventaris Routes (CRUD)
    $routes->get('inventaris', 'InventarisController::index');           // Get all
    $routes->get('inventaris/(:num)', 'InventarisController::show/$1');  // Get by ID
    $routes->post('inventaris', 'InventarisController::create');         // Create
    $routes->put('inventaris/(:num)', 'InventarisController::update/$1'); // Update
    $routes->delete('inventaris/(:num)', 'InventarisController::delete/$1'); // Delete
});
