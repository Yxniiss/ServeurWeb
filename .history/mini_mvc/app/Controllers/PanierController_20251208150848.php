<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;

final class PanierController extends Controller
{
    public function index(): void
    {
        $this->render('panier/index', params: [
            'title' => 'Votre panier',
        ]);
    }
}
