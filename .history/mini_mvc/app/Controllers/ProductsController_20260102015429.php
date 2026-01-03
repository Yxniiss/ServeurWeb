<?php

namespace Mini\Controllers;

use Mini\Models\Product;
use Mini\Models\Category;

class ProductsController
{
    // Liste des produits avec filtre catégorie
    public function liste()
    {
        $categories = Category::getAll();

        $categoryId = isset($_GET['category']) ? (int)$_GET['category'] : null;

        if ($categoryId) {
            $products = Product::getByCategory($categoryId);
        } else {
            $products = Product::getAll();
        }

        $title = 'Tous les produits';

        ob_start();
        require __DIR__ . '/../Views/product/liste.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layout.php';
    }

    // Fiche produit
    public function show()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

        if (!$id || !($product = Product::getById($id))) {
            header('Location: /liste');
            exit;
        }

        $title = htmlspecialchars($product['name']);

        ob_start();
        require __DIR__ . '/../Views/product/show.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layout.php';
    }
}
