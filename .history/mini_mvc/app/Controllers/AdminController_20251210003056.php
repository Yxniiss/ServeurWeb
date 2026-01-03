<?php

namespace Mini\Controllers;

use Mini\Core\Auth;

class AdminController
{
    public function index()
    {
        var_dump($_SESSION);
        Auth::requireAdmin();  // Sécurité admin
        require_once __DIR__ . '/../Views/admin/dashboard.php';
    }

    public function adminProducts()
    {
        Auth::requireAdmin();
        // ici code pour gérer les produits (CRUD)
        require_once __DIR__ . '/../Views/admin/products.php';
    }
}
