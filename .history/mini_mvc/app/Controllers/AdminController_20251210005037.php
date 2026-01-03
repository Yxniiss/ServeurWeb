<?php

namespace Mini\Controllers;

use Mini\Core\Auth;
use Mini\Core\Database;
use PDO;

class AdminController
{
    public function index()
    {
        Auth::requireAdmin(); // sécurité admin
        require_once __DIR__ . '/../Views/admin/dashboard.php';
    }

    public function adminProducts()
    {
        Auth::requireAdmin();
        $pdo = Database::getPDO();

        // Récupère tous les produits
        $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../Views/admin/products.php';
    }

    public function createProduct()
    {
        Auth::requireAdmin();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;

            // Gestion de l'upload d'image
            $imageName = null;
            if (!empty($_FILES['image']['name'])) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $imageName = uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../public/images/products/' . $imageName);
            }

            if (!$name || !$description || !$price || !$imageName) {
                $error = "Tous les champs sont obligatoires avec une image.";
            } else {
                $pdo = Database::getPDO();
                $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image) VALUES (:name, :description, :price, :image)");
                $stmt->execute([
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'image' => $imageName
                ]);
                header('Location: /admin/products');
                exit;
            }
        }

        require_once __DIR__ . '/../Views/admin/product_create.php';
    }

    public function editProduct()
    {
        Auth::requireAdmin();
        $pdo = Database::getPDO();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: /admin/products');
            exit;
        }

        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            header('Location: /admin/products');
            exit;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;

            // Upload nouvelle image si existante
            if (!empty($_FILES['image']['name'])) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $imageName = uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../public/images/products/' . $imageName);
            } else {
                $imageName = $product['image']; // garde l'ancienne
            }

            $stmt = $pdo->prepare("UPDATE products SET name=:name, description=:description, price=:price, image=:image WHERE id=:id");
            $stmt->execute([
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'image' => $imageName,
                'id' => $id
            ]);

            header('Location: /admin/products');
            exit;
        }

        require_once __DIR__ . '/../Views/admin/product_edit.php';
    }

    public function deleteProduct()
    {
        Auth::requireAdmin();
        $pdo = Database::getPDO();
        $id = $_GET['id'] ?? null;

        if ($id) {
            $stmt = $pdo->prepare("DELETE FROM products WHERE id=:id");
            $stmt->execute(['id' => $id]);
        }

        header('Location: /admin/products');
        exit;
    }
}
