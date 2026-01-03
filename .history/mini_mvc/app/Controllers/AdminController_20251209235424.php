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

    public function admin()
    {
        Auth::requireAdmin();  // Sécurité admin
        require __DIR__ . '/../Views/admin/dashboard.php';
    }
}
