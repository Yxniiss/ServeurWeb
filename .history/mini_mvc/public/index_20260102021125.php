<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Mini\Core\Router;

$routes = [
    ['GET', '/', [Mini\Controllers\HomeController::class, 'index']],

    ['GET', '/liste', [Mini\Controllers\ProductsController::class, 'liste']],
    ['GET', '/products', [Mini\Controllers\ProductsController::class, 'show']],

    ['GET', '/panier', [Mini\Controllers\PanierController::class, 'index']],
    ['GET', '/panier/add', [Mini\Controllers\PanierController::class, 'add']],
    ['GET', '/panier/remove', [Mini\Controllers\PanierController::class, 'remove']],
    ['POST', '/panier/update', [Mini\Controllers\PanierController::class, 'update']],

    ['GET', '/connexion', [Mini\Controllers\AuthController::class, 'connexion']],
    ['POST', '/connexion', [Mini\Controllers\AuthController::class, 'connexion']],
    ['GET', '/inscription', [Mini\Controllers\AuthController::class, 'inscription']],
    ['POST', '/inscription', [Mini\Controllers\AuthController::class, 'inscription']],
    ['GET', '/deconnexion', [Mini\Controllers\AuthController::class, 'deconnexion']],

    ['GET', '/admin', [Mini\Controllers\AdminController::class, 'index']],
    ['GET', '/admin/products', [Mini\Controllers\AdminController::class, 'adminProducts']],
    ['GET', '/admin/products/create', [Mini\Controllers\AdminController::class, 'createProduct']],
    ['POST', '/admin/products/create', [Mini\Controllers\AdminController::class, 'createProduct']],
    ['GET', '/admin/products/edit', [Mini\Controllers\AdminController::class, 'editProduct']],
    ['POST', '/admin/products/edit', [Mini\Controllers\AdminController::class, 'editProduct']],
    ['GET', '/admin/products/delete', [Mini\Controllers\AdminController::class, 'deleteProduct']],

    ['GET', '/admin/categories', [Mini\Controllers\AdminController::class, 'adminCategories']],
    ['GET', '/admin/categories/create', [Mini\Controllers\AdminController::class, 'createCategory']],
    ['POST', '/admin/categories/create', [Mini\Controllers\AdminController::class, 'createCategory']],
    ['GET', '/admin/categories/delete', [Mini\Controllers\AdminController::class, 'deleteCategory']],

];

$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
