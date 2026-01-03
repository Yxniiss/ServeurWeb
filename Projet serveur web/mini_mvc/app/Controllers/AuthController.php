<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\User;

final class AuthController extends Controller
{
    private function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function connexion(): void
    {
        $this->startSession();

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = User::getByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['username'];
                $_SESSION['is_admin'] = $user['is_admin'];

                header('Location: /liste');
                exit;
            } else {
                $error = "Email ou mot de passe incorrect";
            }
        }

        $this->render('auth/login', [
            'title' => 'Connexion',
            'error' => $error
        ]);
    }

    public function inscription(): void
    {
        $this->startSession();

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (User::getByEmail($email)) {
                $error = "Cet email est déjà utilisé";
            } else {
                $userId = User::create($username, $email, $password);

                $_SESSION['user_id'] = $userId;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $username;
                $_SESSION['is_admin'] = 0;

                header('Location: /liste');
                exit;
            }
        }

        $this->render('auth/register', [
            'title' => 'Inscription',
            'error' => $error
        ]);
    }

    public function deconnexion(): void
    {
        $this->startSession();

        session_unset();
        session_destroy();

        header('Location: /connexion');
        exit;
    }
}
