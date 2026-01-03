<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Product; // On utilise le modèle Product

final class ProductsController extends Controller
{
    public function liste(): void
    {
        // Données temporaires pour tester
        $products = [
            ['id' => 1, 'name' => 'Ballon Spalding', 'price' => 29],
            ['id' => 2, 'name' => 'Maillot Lakers', 'price' => 89],
            ['id' => 3, 'name' => 'Chaussures Jordan', 'price' => 149],
        ];

        $this->render('product/liste', params: [
            'products' => $products,
            'title' => 'Liste des produits',
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
