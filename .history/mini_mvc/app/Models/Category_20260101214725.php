<?php

namespace Mini\Models;

use Mini\Core\Database;

class Category
{
    // Récupérer toutes les catégories
    public static function all(): array
    {
        $pdo = Database::getPDO();
        return $pdo
            ->query("SELECT * FROM categories ORDER BY name ASC")
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Récupérer une catégorie par ID
    public static function find(int $id): ?array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $category = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $category ?: null;
    }

    // Créer une catégorie
    public static function create(string $name): void
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
        $stmt->execute(['name' => $name]);
    }

    // Supprimer une catégorie
    public static function delete(int $id): bool
    {
        $pdo = Database::getPDO();

        // Vérifier si des produits sont liés
        $check = $pdo->prepare("SELECT COUNT(*) FROM products WHERE category_id = :id");
        $check->execute(['id' => $id]);

        if ($check->fetchColumn() > 0) {
            return false;
        }

        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->execute(['id' => $id]);

        return true;
    }
}
