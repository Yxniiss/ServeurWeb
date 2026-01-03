<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Product; // On utilise le modèle Product

final class ProductsController extends Controller
{
    public function liste(): void
    {
        $products = Product::getAll(); // Récupère tous les produits
        $this->render('product/liste', params: [
            'products' => $products,
            'title' => 'Liste des Produits',
        ]);
    }

    public function show(): void
{
    $id = $_GET['id'] ?? null;
    if ($id === null) {
        header('Location: /liste');
        exit;
    }

    $product = Product::getById((int)$id);

    $this->render('product/show', [
        'product' => $product,
        'title' => $product['name'] ?? 'Produit'
    ]);
}

}
