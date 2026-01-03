<?php

namespace Mini\Controllers;

use Mini\Core\Auth;

class AdminController
{
    public function index()
    {
        Auth::requireAdmin();  // ⛔ Bloque l’accès si pas admin

        // code pour afficher le dashboard admin
        require_once __DIR__ . '/../Views/admin/dashboard.php';
    }

    public function admin()
{
    $this->requireAdmin(); // sécurité obligatoire
    require __DIR__ . '/../Views/admin/dashboard.php';
}

}
