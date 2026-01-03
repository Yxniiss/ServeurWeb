<?php

namespace Mini\Core;

class Auth
{
    public static function requireAdmin()
    {
        if (!isset($_SESSION['user_id']) || empty($_SESSION['is_admin'])) {
            header("Location: /"); // ou page erreur 403
            exit;
        }
    }
}
