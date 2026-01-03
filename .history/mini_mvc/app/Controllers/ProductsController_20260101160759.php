<?php

namespace Mini\Controllers;

use Mini\Core\Database;

class ProductsController
{
    /**
     * Liste des produits + filtres par catégorie
     * URL :
     *  - /liste
     *  - /liste?category=ID
     */
    public function liste()
    {
        $pdo = Database::getPDO();

        // 🔹 Récupérer toutes les catégories (menu)
        $categories = $pdo
            ->query("SELECT * FROM categories ORDER BY name ASC")
            ->fetchAll(\PDO::FETCH_ASSOC);

        // 🔹 Catégorie sélectionnée (optionnelle)
        $categoryId = $_GET['category'] ?? null;

        if ($categoryId) {
            // Produits filtrés par catégorie
            $stmt = $pdo->prepare("
                SELECT * FROM products
                WHERE category_id = :category_id
                ORDER BY id DESC
            ");
            $stmt->execute([
                'category_id' => $categoryId
            ]);
            $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            // Tous les produits
            $products = $pdo
                ->query("SELECT * FROM products ORDER BY id DESC")
                ->fetchAll(\PDO::FETCH_ASSOC);
        }

        require_once __DIR__ . '/../Views/product/liste.php';
    }

    /**
     * Fiche produit
     * URL :
     *  - /products?id=ID
     */
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

        require_once __DIR__ . '/../Views/products/show.php';
    }
}
