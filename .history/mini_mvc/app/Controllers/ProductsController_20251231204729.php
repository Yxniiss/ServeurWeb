<?php

namespace Mini\Controllers;

use Mini\Core\Database;

class ProductsController
{
    public function liste(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $pdo = Database::getPDO();

        // 🔹 Récupérer toutes les catégories pour le menu
        $categories = $pdo->query("SELECT * FROM categories")->fetchAll(\PDO::FETCH_ASSOC);

        // 🔹 Vérifier si une catégorie est sélectionnée via l'URL
        $category_id = $_GET['category'] ?? null;

        if ($category_id) {
            $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = :category_id ORDER BY id DESC");
            $stmt->execute(['category_id' => $category_id]);
            $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            $products = $pdo->query("SELECT * FROM products ORDER BY id DESC")->fetchAll(\PDO::FETCH_ASSOC);
        }

        require_once __DIR__ . '/../Views/product/liste.php';
    }

    public function show(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $pdo = Database::getPDO();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: /liste');
            exit;
        }

        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$product) {
            header('Location: /liste');
            exit;
        }

        require_once __DIR__ . '/../Views/product/show.php';
    }
}
