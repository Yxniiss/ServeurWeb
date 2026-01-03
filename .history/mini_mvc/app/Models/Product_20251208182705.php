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
        $stmt = $pdo->query("SELECT * FROM product ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}