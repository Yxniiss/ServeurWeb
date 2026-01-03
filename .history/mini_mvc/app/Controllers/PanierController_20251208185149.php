<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;

final class PanierController extends Controller
{
    public function index(): void
    {
        $this->render('panier/index', params: [
            'title' => 'Votre panier',
        ]);
    }

    public function add(): void
{
    session_start(); // Démarre la session

    $id = $_GET['id'] ?? null;
    if (!$id) {
        header('Location: /liste');
        exit;
    }

    $product = Product::getById((int)$id);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Vérifie si le produit est déjà dans le panier
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product['id']) {
            $item['quantity']++;
            $found = true;
            break;
        }
    }
    unset($item);

    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1
        ];
    }

    header('Location: /panier'); // Redirige vers le panier
    exit;
}

}
