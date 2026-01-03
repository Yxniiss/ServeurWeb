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

    $cart = $_SESSION['cart'] ?? [];

    $this->render('panier/index', [
        'title' => 'Votre panier',
        'cart' => $cart
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

public function remove(): void
{
    session_start();

    $id = $_GET['id'] ?? null;
    if (!$id || !isset($_SESSION['cart'])) {
        header('Location: /panier');
        exit;
    }

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    $_SESSION['cart'] = array_values($_SESSION['cart']); // Réindexe le tableau
    header('Location: /panier');
    exit;
}


}
