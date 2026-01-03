<?php

namespace Mini\Controllers;

use Mini\Core\Auth;

class AdminController
{
    public function index()
    {
        Auth::requireAdmin();  // Sécurité admin
        require_once __DIR__ . '/../Views/admin/dashboard.php';
    }

    public function adminProducts()
    {
        var_dump($_SESSION);
        Auth::requireAdmin();
        // ici code pour gérer les produits (CRUD)
        require_once __DIR__ . '/../Views/admin/products.php';
    }
}
