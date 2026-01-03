<?php

namespace Mini\Controllers;

use Mini\Models\Product;
use Mini\Models\Category;

class ProductsController
{
    // Méthode privée pour centraliser le rendu
    private function render(string $view, array $data = []): void
    {
        extract($data);
        ob_start();
        require __DIR__ . "/../Views/$view.php";
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    public function liste()
    {
        $categories = Category::All();
        $categoryId = isset($_GET['category']) ? (int)$_GET['category'] : null;

        $products = $categoryId ? Product::getByCategory($categoryId) : Product::getAll();

        $this->render('product/liste', [
            'title' => 'Tous les produits',
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function show()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

        if (!$id || !($product = Product::getById($id))) {
            header('Location: /liste');
            exit;
        }

        $this->render('product/show', [
            'title' => htmlspecialchars($product['name']),
            'product' => $product
        ]);
    }
}
