<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Core\Database;
use PDO;

final class PanierController extends Controller
{
    public function index(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /connexion');
            exit;
        }

        $userId = $_SESSION['user_id'];

        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("
            SELECT ci.quantity, p.id, p.name, p.price
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.id
            WHERE ci.user_id = :user_id
        ");
        $stmt->execute(['user_id' => $userId]);
        $cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $this->render('panier/index', [
            'title' => 'Votre panier',
            'cart' => $cart,
            'total' => $total
        ]);
    }

    public function add(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /connexion');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $productId = (int)($_GET['id'] ?? 0);
        if (!$productId) {
            header('Location: /liste');
            exit;
        }

        $pdo = Database::getPDO();

        $stmt = $pdo->prepare("SELECT * FROM cart_items WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            $stmt = $pdo->prepare("UPDATE cart_items SET quantity = quantity + 1 WHERE id = :id");
            $stmt->execute(['id' => $item['id']]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO cart_items (user_id, product_id, quantity) VALUES (:user_id, :product_id, 1)");
            $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        }

        header('Location: /panier');
        exit;
    }

    public function remove(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /connexion');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $productId = (int)($_GET['id'] ?? 0);
        if (!$productId) {
            header('Location: /panier');
            exit;
        }

        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM cart_items WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);

        header('Location: /panier');
        exit;
    }
}
