<?php

// Ici je définit le namespace ou il y aura ma class
namespace Mini\Models;

use Mini\Core\Database;
use Mini\Core\Model;
use PDO;

class Product extends Model
{
    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById(int $id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
