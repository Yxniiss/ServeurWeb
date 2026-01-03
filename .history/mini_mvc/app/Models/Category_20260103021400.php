<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Category
{
    public static function all(): array
    {
        $pdo = Database::getPDO();
        return $pdo
            ->query("SELECT * FROM categories ORDER BY name ASC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): ?array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        return $category ?: null;
    }

    public static function create(string $name): void
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
        $stmt->execute(['name' => $name]);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::getPDO();

        // Vérifie si des produits existent dans cette catégorie
        $check = $pdo->prepare("SELECT COUNT(*) FROM products WHERE category_id = :id");
        $check->execute(['id' => $id]);

        if ((int)$check->fetchColumn() > 0) {
            return false;
        }

        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->execute(['id' => $id]);

        return true;
    }
}
