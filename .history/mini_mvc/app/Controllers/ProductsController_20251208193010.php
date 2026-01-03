<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Core\Database;
use PDO;

final class ProductsController extends Controller
{
    public function liste(): void
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

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
