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
        $stmt = Database::getPDO()->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function getBestsellers(): array
    {
        $stmt = Database::getPDO()->query("SELECT * FROM products WHERE is_best_seller = 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data): void
    {
        $stmt = Database::getPDO()->prepare("
            INSERT INTO products (name, description, price, image, category_id, is_best_seller)
            VALUES (:name, :description, :price, :image, :category_id, :is_best_seller)
        ");
        $stmt->execute([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => $data['image'],
            'category_id' => $data['category_id'],
            'is_best_seller' => $data['is_best_seller'] ?? 0
        ]);
    }

    public static function update(int $id, array $data): void
    {
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
        $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => $data['image'],
            'category_id' => $data['category_id'],
            'is_best_seller' => $data['is_best_seller'] ?? 0
        ]);
    }

    public static function delete(int $id): void
    {
        $stmt = Database::getPDO()->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
