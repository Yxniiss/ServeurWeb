<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;

final class AuthController extends Controller
{
    // Page connexion
    public function connexion(): void
    {
        session_start();

        // Si formulaire soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Pour l'instant on accepte n'importe quel email/mot de passe
            // Juste pour tester le panier et la session
            $_SESSION['user_id'] = $email; // on stocke l'email comme "id"
            $_SESSION['user_email'] = $email;

            header('Location: /liste');
            exit;
        }

        $this->render('auth/connexion', ['title' => 'Connexion']);
    }

    // Page inscription
    public function inscription(): void
    {
        session_start();

        // Si formulaire soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Ici, on simule juste l'inscription : on stocke dans la session
            $_SESSION['user_id'] = $email;
            $_SESSION['user_email'] = $email;

            header('Location: /liste');
            exit;
        }

        $this->render('auth/inscription', ['title' => 'Inscription']);
    }

    // Déconnexion
    public function deconnexion(): void
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /connexion');
        exit;
    }
}
