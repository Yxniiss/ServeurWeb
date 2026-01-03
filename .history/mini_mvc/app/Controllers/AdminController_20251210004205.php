<?php

namespace Mini\Controllers;

use Mini\Core\Auth;

class AdminController
{
    public function index()
    {
        // ⚡ Démarrage de la session si nécessaire
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        var_dump($_SESSION); // pour debug
        // Sécurité admin
        Auth::requireAdmin();

        require_once __DIR__ . '/../Views/admin/dashboard.php';
    }

    public function adminProducts()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        Auth::requireAdmin();
        require_once __DIR__ . '/../Views/admin/products.php';
    }
}
