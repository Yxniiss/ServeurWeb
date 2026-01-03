<?php

namespace Mini\Models;

use Mini\Core\Database;

class Category
{
    public static function getAll(): array
    {
        return Database::getPDO()
            ->query("SELECT * FROM categories ORDER BY name ASC")
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function create(string $name): void
    {
        $stmt = Database::getPDO()->prepare(
            "INSERT INTO categories (name) VALUES (:name)"
        );
        $stmt->execute(['name' => $name]);
    }

    public static function delete(int $id): void
    {
        $stmt = Database::getPDO()->prepare(
            "DELETE FROM categories WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
    }
}
