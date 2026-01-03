<?php

namespace Mini\Controllers;

use Mini\Core\Database;

class ProductsController
{
    // Liste des produits + filtre catégories
    public function liste()
    {
        $pdo = Database::getPDO();

        $categories = $pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll(\PDO::FETCH_ASSOC);
        $categoryId = $_GET['category'] ?? null;

        if ($categoryId) {
            $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = :category_id ORDER BY id DESC");
            $stmt->execute(['category_id' => $categoryId]);
            $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            $products = $pdo->query("SELECT * FROM products ORDER BY id DESC")->fetchAll(\PDO::FETCH_ASSOC);
        }

        // Capturer le contenu de la vue
        ob_start();
        require __DIR__ . '/../Views/product/liste.php';
        $content = ob_get_clean();

        $title = 'Tous les produits';
        require __DIR__ . '/../Views/layout.php';
    }

    // Fiche produit
    public function show()
    {
        $pdo = Database::getPDO();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: /liste');
            exit;
        }

        $stmt = $pdo->prepare("
            SELECT p.*, c.name AS category_name
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.id = :id
        ");
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$product) {
            header('Location: /liste');
            exit;
        }

        // Capturer le contenu
        ob_start();
        require __DIR__ . '/../Views/product/show.php';
        $content = ob_get_clean();

        $title = htmlspecialchars($product['name']);
        require __DIR__ . '/../Views/layout.php';
    }
}
