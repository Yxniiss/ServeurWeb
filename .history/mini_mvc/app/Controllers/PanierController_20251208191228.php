<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Product;

final class PanierController extends Controller
{
    public function index(): void
    {
        session_start();
        $userId = $_SESSION['user_id'] ?? 'guest';

        $cart = $_SESSION['cart'][$userId] ?? [];

        // Calcul du total
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
        $userId = $_SESSION['user_id'] ?? 'guest';
        $productId = (int)($_GET['id'] ?? 0);

        if (!$productId) {
            header('Location: /liste');
            exit;
        }

        $product = Product::getById($productId);
        if (!$product) {
            header('Location: /liste');
            exit;
        }

        if (!isset($_SESSION['cart'][$userId])) {
            $_SESSION['cart'][$userId] = [];
        }

        $found = false;
        foreach ($_SESSION['cart'][$userId] as &$item) {
            if ($item['id'] === $product['id']) {
                $item['quantity']++;
                $found = true;
                break;
            }
        }
        unset($item);

        if (!$found) {
            $_SESSION['cart'][$userId][] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }

        header('Location: /panier');
        exit;
    }

    public function remove(): void
    {
        session_start();
        $userId = $_SESSION['user_id'] ?? 'guest';
        $productId = (int)($_GET['id'] ?? 0);

        if (isset($_SESSION['cart'][$userId])) {
            foreach ($_SESSION['cart'][$userId] as $key => $item) {
                if ($item['id'] === $productId) {
                    unset($_SESSION['cart'][$userId][$key]);
                    break;
                }
            }
        }

        header('Location: /panier');
        exit;
    }
}
