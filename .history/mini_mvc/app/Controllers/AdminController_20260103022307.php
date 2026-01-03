<?php

namespace Mini\Controllers;

use Mini\Core\Auth;
use Mini\Models\Product;
use Mini\Models\Category;

class AdminController
{
    // Méthode privée pour session + vérification admin
    private function startSessionAndAuth()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        Auth::requireAdmin();
    }

    public function index()
    {
        $this->startSessionAndAuth();

        $title = 'Tableau de bord';
        ob_start();
        require __DIR__ . '/../Views/admin/dashboard.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    public function adminProducts()
    {
        $this->startSessionAndAuth();

        $products = Product::getAll();

        $title = 'Gestion des produits';
        ob_start();
        require __DIR__ . '/../Views/admin/products.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    public function createProduct()
    {
        $this->startSessionAndAuth();

        $categories = Category::All();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $categoryId = $_POST['category_id'] ?? null;

            $imageName = null;
            if (!empty($_FILES['image']['name'])) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $imageName = uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../public/images/products/' . $imageName);
            }

            if (!$name || !$description || !$price || !$imageName || !$categoryId) {
                $error = "Tous les champs sont obligatoires.";
            } else {
                Product::create([
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'image' => $imageName,
                    'category_id' => $categoryId,
                    'is_best_seller' => $_POST['is_best_seller'] ?? 0
                ]);

                header('Location: /admin/products');
                exit;
            }
        }

        $title = 'Ajouter un produit';
        ob_start();
        require __DIR__ . '/../Views/admin/create_product.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    public function editProduct()
    {
        $this->startSessionAndAuth();

        $id = $_GET['id'] ?? null;
        if (!$id || !($product = Product::getById((int)$id))) {
            header('Location: /admin/products');
            exit;
        }

        $categories = Category::All();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $categoryId = $_POST['category_id'] ?? null;
            $isBestseller = isset($_POST['is_best_seller']) ? 1 : 0;

            $imageName = $product['image'];
            if (!empty($_FILES['image']['name'])) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $imageName = uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../public/images/products/' . $imageName);
            }

            if (!$name || !$description || !$price || !$categoryId) {
                $error = "Tous les champs sont obligatoires.";
            } else {
                Product::update((int)$id, [
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'image' => $imageName,
                    'category_id' => $categoryId,
                    'is_best_seller' => $isBestseller
                ]);

                header('Location: /admin/products');
                exit;
            }
        }

        $title = 'Modifier le produit';
        ob_start();
        require __DIR__ . '/../Views/admin/edit_product.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    public function deleteProduct()
    {
        $this->startSessionAndAuth();

        $id = $_GET['id'] ?? null;
        if ($id) Product::delete((int)$id);

        header('Location: /admin/products');
        exit;
    }

    public function adminCategories()
    {
        $this->startSessionAndAuth();

        $categories = Category::All();

        $title = 'Gestion des catégories';
        ob_start();
        require __DIR__ . '/../Views/admin/categories.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    public function createCategory()
    {
        $this->startSessionAndAuth();

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            if (!$name) {
                $error = "Le nom de la catégorie est obligatoire.";
            } else {
                Category::create($name);
                header('Location: /admin/categories');
                exit;
            }
        }

        $title = 'Créer une catégorie';
        ob_start();
        require __DIR__ . '/../Views/admin/create_category.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    public function deleteCategory()
    {
        $this->startSessionAndAuth();

        $id = $_GET['id'] ?? null;
        if ($id) {
            $success = Category::deleteWithCheck((int)$id);
            if (!$success) {
                $_SESSION['error'] = "Impossible de supprimer : cette catégorie contient des produits.";
            }
        }

        header('Location: /admin/categories');
        exit;
    }
}
