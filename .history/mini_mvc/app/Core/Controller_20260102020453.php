<?php
declare(strict_types=1);
namespace Mini\Core;
class Controller
{
    protected function render(string $view, array $params = []): void
    {
        extract(array: $params);
        $viewFile = dirname(__DIR__) . '/Views/' . $view . '.php';
        $layoutFile = dirname(__DIR__) . '/Views/layout.php';

        ob_start();
        require $viewFile;
        
        $content = ob_get_clean();

        require $layoutFile;
    }

    protected function checkAuth(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        header('Location: /connexion');
        exit;
    }
}

public function requireAdmin(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
        header('Location: /connexion');
        exit;
    }
}


}


