<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Product
{
    public static function getAll(): array
    {
        $stmt = Database::getPDO()->query("SELECT * FROM products ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public static function getById(int $id): ?array
{
    $stmt = Database::getPDO()->prepare("
        SELECT p.*, c.name AS category_name
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.id = :id
    ");
    $stmt->execute(['id' => $id]);
    $product = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $product ?: null;
}
    public static function getByCategory(?int $categoryId): array
    {
        if (!$categoryId) return [];
        $stmt = Database::getPDO()->prepare(
            "SELECT * FROM products WHERE category_id = :category_id ORDER BY id DESC"
        );
        $stmt->execute(['category_id' => $categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getBestsellers(): array
    {
        $stmt = Database::getPDO()->query(
            "SELECT * FROM products WHERE is_best_seller = 1 ORDER BY id DESC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data): void
    {
        $stmt = Database::getPDO()->prepare("
            INSERT INTO products (name, description, price, image, category_id, is_best_seller)
            VALUES (:name, :description, :price, :image, :category_id, :is_best_seller)
        ");
        $stmt->execute($data);
    }

    public static function update(int $id, array $data): void
    {
        $data['id'] = $id;
        $stmt = Database::getPDO()->prepare("
            UPDATE products SET
                name = :name,
                description = :description,
                price = :price,
                image = :image,
                category_id = :category_id,
                is_best_seller = :is_best_seller
            WHERE id = :id
        ");
        $stmt->execute($data);
    }

    public static function delete(int $id): void
    {
        $stmt = Database::getPDO()->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
