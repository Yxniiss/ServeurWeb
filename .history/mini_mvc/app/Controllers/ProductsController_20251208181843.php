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
        // Produit temporaire pour tester
        $product = [
            'id' => 1,
            'name' => 'Ballon Spalding',
            'price' => 29,
            'description' => 'Ballon officiel de basketball.',
        ];

        $this->render('product/show', params: [
            'product' => $product,
            'title' => $product['name'],
        ]);
    }
}
