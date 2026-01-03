<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Product;

final class HomeController extends Controller
{
    public function index(): void
    {
        $bestsellers = Product::getBestsellers();

        $this->render('home/index', [
            'bestsellers' => $bestsellers
        ]);
    }
}
