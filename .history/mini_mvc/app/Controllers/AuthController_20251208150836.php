<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;

final class AuthController extends Controller
{
    public function connexion(): void
    {
        $this->render('auth/login', params: [
            'title' => 'Connexion',
        ]);
    }

    public function inscription(): void
    {
        $this->render('auth/register', params: [
            'title' => 'Inscription',
        ]);
    }
}
