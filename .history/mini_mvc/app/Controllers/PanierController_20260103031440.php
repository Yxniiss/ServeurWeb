<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Cart;

final class PanierController extends Controller
{
    public function index(): void
    {
        $this->checkAuth();

        $userId = $_SESSION['user_id'];
        $cart = Cart::getItems($userId);

        $total = array_reduce($cart, fn($sum, $item) => $sum + $item['price'] * $item['quantity'], 0);

        $this->render('panier/index', [
            'title' => 'Votre panier',
            'cart' => $cart,
            'total' => $total
        ]);
    }

    public function add(): void
    {
        $this->checkAuth();

        $userId = $_SESSION['user_id'];
        $productId = (int)($_GET['id'] ?? 0);
        if (!$productId) {
            header('Location: /liste');
            exit;
        }

        Cart::addItem($userId, $productId);

        header('Location: /panier');
        exit;
    }

    
    public function remove(): void
    {
        $this->checkAuth();

        $userId = $_SESSION['user_id'];
        $productId = (int)($_GET['id'] ?? 0);
        if (!$productId) {
            header('Location: /panier');
            exit;
        }

        Cart::removeItem($userId, $productId);

        header('Location: /panier');
        exit;
    }

    public function update(): void
{
    $this->checkAuth();

    $userId = $_SESSION['user_id'];
    $productId = (int)($_POST['id'] ?? 0);
    $quantity = (int)($_POST['quantity'] ?? 1);

    if ($productId > 0) {
        Cart::updateQuantity($userId, $productId, $quantity);
    }

    header('Location: /panier');
    exit;
}

}
