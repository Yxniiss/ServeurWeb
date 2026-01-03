<?php

declare(strict_types=1);

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Cart
{
    public static function getItems(int $userId): array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("
            SELECT ci.quantity, p.id, p.name, p.price, p.image
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.id
            WHERE ci.user_id = :user_id
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addItem(int $userId, int $productId): void
    {
        $pdo = Database::getPDO();

        $stmt = $pdo->prepare("SELECT * FROM cart_items WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            $stmt = $pdo->prepare("UPDATE cart_items SET quantity = quantity + 1 WHERE id = :id");
            $stmt->execute(['id' => $item['id']]);
        } else {
            $stmt = $pdo->prepare("
                INSERT INTO cart_items (user_id, product_id, quantity) 
                VALUES (:user_id, :product_id, 1)
            ");
            $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        }
    }

    
    public static function removeItem(int $userId, int $productId): void
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM cart_items WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
    }

    public static function updateQuantity(int $userId, int $productId, int $quantity): void
    {
        $pdo = Database::getPDO();

        if ($quantity <= 0) {
            $stmt = $pdo->prepare("DELETE FROM cart_items WHERE user_id = :user_id AND product_id = :product_id");
            $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        } else {
            $stmt = $pdo->prepare("
                UPDATE cart_items 
                SET quantity = :quantity 
                WHERE user_id = :user_id AND product_id = :product_id
            ");
            $stmt->execute([
                'quantity' => $quantity,
                'user_id' => $userId,
                'product_id' => $productId
            ]);
        }
    }
}
