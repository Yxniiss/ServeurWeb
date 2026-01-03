<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Product; // On utilise le modèle Product

final class ProductsController extends Controller
{
    // /liste → liste tous les produits
    public function liste(): void
    {
        // On récupère tous les produits depuis la BDD
        $products = Product::getAll();

        $this->render('product/liste', params: [
            'products' => $products,
            'title' => 'Liste des produits',
        ]);
    }

    // /product → détail d’un produit
    public function show(int $id): void
    {
        // On récupère le produit par son ID depuis la BDD
        $product = Product::getById($id);

        $this->render('product/show', params: [
            'product' => $product,
            'title' => $product->name ?? 'Produit',
        ]);
    }
    
}
