<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Mini\Core\Router;

// Table des routes minimaliste
$routes = [
    ['GET', '/', [Mini\Controllers\HomeController::class, 'index']],
    ['GET', '/users', [Mini\Controllers\HomeController::class, 'users']],
    ['GET', '/listproducts', [Mini\Controllers\HomeController::class, 'listproducts']],
    ['GET', '/products', [Mini\Controllers\HomeController::class, 'products']],
    ['GET', '/panier', [Mini\Controllers\HomeController::class, 'panier']],
    ['GET', '/connexion', [Mini\Controllers\HomeController::class, 'connexion']],
    ['GET', '/inscription', [Mini\Controllers\HomeController::class, 'inscription']],
];

// Bootstrap du router
$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);


