<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Mini\Core\Router;

// Table des routes minimaliste
$routes = [
    ['GET', '/', [Mini\Controllers\HomeController::class, 'index']],
    ['GET', '/users', [Mini\Controllers\HomeController::class, 'users']],
    ['GET', '/listproducts', [Mini\Controllers\ProductsController::class, 'liste']],
    ['GET', '/products', [Mini\Controllers\ProductsController::class, 'products']],
    ['GET', '/panier', [Mini\Controllers\PanierController::class, 'panier']],
    ['GET', '/connexion', [Mini\Controllers\AuthController::class, 'connexion']],
    ['GET', '/inscription', [Mini\Controllers\AuthController::class, 'inscription']],
];

// Bootstrap du router
$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);


