<?php

namespace Mini\Core;

class Auth
{
    public static function requireAdmin()
    {
        if (!isset($_SESSION['user_id']) || (int)$_SESSION['is_admin'] !== 1) {
    header("Location: /"); 
    exit;}

    }
}
