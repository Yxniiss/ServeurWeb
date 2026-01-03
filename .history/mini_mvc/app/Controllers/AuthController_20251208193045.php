<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Core\Database;
use PDO;

final class AuthController extends Controller
{
    public function connexion(): void
    {
        session_start();

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $pdo = Database::getPDO();
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['username'];

                header('Location: /liste');
                exit;
            } else {
                $error = "Email ou mot de passe incorrect";
            }
        }

        $this->render('auth/login', ['title' => 'Connexion', 'error' => $error]);
    }

    public function inscription(): void
    {
        session_start();

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $pdo = Database::getPDO();

            // Vérifie si l’email existe déjà
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            if ($stmt->fetch()) {
                $error = "Cet email est déjà utilisé";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
                $stmt->execute(['username' => $username, 'email' => $email, 'password' => $hash]);

                $userId = $pdo->lastInsertId();
                $_SESSION['user_id'] = $userId;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $username;

                header('Location: /liste');
                exit;
            }
        }

        $this->render('auth/register', ['title' => 'Inscription', 'error' => $error]);
    }

    public function deconnexion(): void
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /connexion');
        exit;
    }
}
