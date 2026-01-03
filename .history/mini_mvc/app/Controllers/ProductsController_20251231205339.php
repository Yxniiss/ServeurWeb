<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Product;

final class ProductsController extends Controller
{
    public function liste(): void
    {
        $products = Product::getAll();

        $this->render('product/liste', [
            'title' => 'Liste des produits',
            'products' => $products
        ]);
    }

    public function show(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if (!$id) {
            header('Location: /liste');
            exit;
        }

        $product = Product::getById($id);
        if (!$product) {
            header('Location: /liste');
            exit;
        }

        $this->render('product/show', [
            'title' => $product['name'],
            'product' => $product
        ]);
    }
}
