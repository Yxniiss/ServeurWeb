<?php
declare(strict_types=1);

namespace Mini\Core;

class Controller
{
    protected function render(string $view, array $params = []): void
    {
        extract($params);

        $viewFile = dirname(__DIR__) . '/Views/' . $view . '.php';
        $layoutFile = dirname(__DIR__) . '/Views/layout.php';

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require $layoutFile;
    }

    private function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    protected function checkAuth(): void
    {
        $this->startSession();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /connexion');
            exit;
        }
    }

    public function requireAdmin(): void
    {
        $this->startSession();

        if (!isset($_SESSION['user_id']) || empty($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
            header('Location: /connexion');
            exit;
        }
    }
}
