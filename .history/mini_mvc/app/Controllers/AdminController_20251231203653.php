<?php

namespace Mini\Controllers;

use Mini\Core\Auth;
use Mini\Core\Database;

class AdminController
{
    /* =======================
       DASHBOARD
    ======================= */
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        Auth::requireAdmin();
        require_once __DIR__ . '/../Views/admin/dashboard.php';
    }

    /* =======================
       PRODUITS
    ======================= */
    public function adminProducts()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        Auth::requireAdmin();

        $pdo = Database::getPDO();
        $products = $pdo->query("
            SELECT p.*, c.name AS category_name
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            ORDER BY p.id DESC
        ")->fetchAll(\PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../Views/admin/products.php';
    }

    /* =======================
       CRÉER PRODUIT
    ======================= */
    public function createProduct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        Auth::requireAdmin();

        $pdo = Database::getPDO();
        $categories = $pdo->query("SELECT * FROM categories")->fetchAll(\PDO::FETCH_ASSOC);

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name        = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price       = $_POST['price'] ?? 0;
            $categoryId  = $_POST['category_id'] ?? null;

            $imageName = null;
            if (!empty($_FILES['image']['name'])) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $imageName = uniqid() . '.' . $ext;
                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    __DIR__ . '/../../public/images/products/' . $imageName
                );
            }

            if (!$name || !$description || !$price || !$imageName || !$categoryId) {
                $error = "Tous les champs sont obligatoires.";
            } else {
                $stmt = $pdo->prepare("
                    INSERT INTO products 
                    (name, description, price, image, category_id)
                    VALUES (:name, :description, :price, :image, :category_id)
                ");
                $stmt->execute([
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'image' => $imageName,
                    'category_id' => $categoryId
                ]);

                header('Location: /admin/products');
                exit;
            }
        }

        require_once __DIR__ . '/../Views/admin/create_product.php';
    }

    /* =======================
       MODIFIER PRODUIT
    ======================= */
    public function editProduct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        Auth::requireAdmin();

        $pdo = Database::getPDO();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: /admin/products');
            exit;
        }

        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$product) {
            header('Location: /admin/products');
            exit;
        }

        $categories = $pdo->query("SELECT * FROM categories")->fetchAll(\PDO::FETCH_ASSOC);

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name        = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price       = $_POST['price'] ?? 0;
            $categoryId  = $_POST['category_id'] ?? null;
            $isBestseller = isset($_POST['is_best_seller']) ? 1 : 0;

            $imageName = $product['image'];
            if (!empty($_FILES['image']['name'])) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $imageName = uniqid() . '.' . $ext;
                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    __DIR__ . '/../../public/images/products/' . $imageName
                );
            }

            if (!$name || !$description || !$price || !$categoryId) {
                $error = "Tous les champs sont obligatoires.";
            } else {
                $stmt = $pdo->prepare("
                    UPDATE products SET
                        name = :name,
                        description = :description,
                        price = :price,
                        image = :image,
                        is_best_seller = :is_best_seller,
                        category_id = :category_id
                    WHERE id = :id
                ");
                $stmt->execute([
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'image' => $imageName,
                    'is_best_seller' => $isBestseller,
                    'category_id' => $categoryId,
                    'id' => $id
                ]);

                header('Location: /admin/products');
                exit;
            }
        }

        require_once __DIR__ . '/../Views/admin/edit_product.php';
    }

    /* =======================
       SUPPRIMER PRODUIT
    ======================= */
    public function deleteProduct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        Auth::requireAdmin();

        $pdo = Database::getPDO();
        $id = $_GET['id'] ?? null;

        if ($id) {
            $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }

        header('Location: /admin/products');
        exit;
    }

    /* =======================
       CATÉGORIES
    ======================= */
    public function adminCategories()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        Auth::requireAdmin();

        $pdo = Database::getPDO();
        $categories = $pdo->query("SELECT * FROM categories")->fetchAll(\PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../Views/admin/categories.php';
    }

    public function createCategory()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');

            if ($name) {
                $pdo = Database::getPDO();
                $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
                $stmt->execute(['name' => $name]);
            }

            header('Location: /admin/categories');
            exit;
        }

        require_once __DIR__ . '/../Views/admin/create_category.php';
    }
}
