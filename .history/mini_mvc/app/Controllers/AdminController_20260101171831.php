<?php

namespace Mini\Controllers;

use Mini\Core\Auth;
use Mini\Core\Database;

class AdminController
{
    // Tableau de bord
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        Auth::requireAdmin();

        $title = 'Tableau de bord';
        ob_start();
        require __DIR__ . '/../Views/admin/dashboard.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    // ----- PRODUITS -----

    // Liste des produits
    public function adminProducts()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        Auth::requireAdmin();

        $pdo = Database::getPDO();
        $products = $pdo->query("SELECT * FROM products ORDER BY id DESC")
                        ->fetchAll(\PDO::FETCH_ASSOC);

        $title = 'Gestion des produits';
        ob_start();
        require __DIR__ . '/../Views/admin/products.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    // Créer un produit
    public function createProduct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        Auth::requireAdmin();

        $pdo = Database::getPDO();
        $categories = $pdo->query("SELECT * FROM categories ORDER BY name ASC")
                          ->fetchAll(\PDO::FETCH_ASSOC);
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $categoryId = $_POST['category_id'] ?? null;

            // Gestion de l'image
            $imageName = null;
            if (!empty($_FILES['image']['name'])) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $imageName = uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../public/images/products/' . $imageName);
            }

            if (!$name || !$description || !$price || !$imageName || !$categoryId) {
                $error = "Tous les champs sont obligatoires.";
            } else {
                $stmt = $pdo->prepare("
                    INSERT INTO products (name, description, price, image, category_id)
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

        $title = 'Ajouter un produit';
        ob_start();
        require __DIR__ . '/../Views/admin/create_product.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    // Modifier un produit
    public function editProduct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
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

        $categories = $pdo->query("SELECT * FROM categories ORDER BY name ASC")
                          ->fetchAll(\PDO::FETCH_ASSOC);
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
                $stmt = $pdo->prepare("
                    UPDATE products SET
                        name = :name,
                        description = :description,
                        price = :price,
                        image = :image,
                        category_id = :category_id,
                        is_best_seller = :is_best_seller
                    WHERE id = :id
                ");
                $stmt->execute([
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'image' => $imageName,
                    'category_id' => $categoryId,
                    'is_best_seller' => $isBestseller,
                    'id' => $id
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

    // Supprimer un produit
    public function deleteProduct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
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

    // ----- CATEGORIES -----

    // Liste des catégories
    public function adminCategories()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        Auth::requireAdmin();

        $pdo = Database::getPDO();
        $categories = $pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll(\PDO::FETCH_ASSOC);

        $title = 'Gestion des catégories';
        ob_start();
        require __DIR__ . '/../Views/admin/categories.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    // Créer une catégorie
    public function createCategory()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        Auth::requireAdmin();

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            if (!$name) {
                $error = "Le nom de la catégorie est obligatoire.";
            } else {
                $pdo = Database::getPDO();
                $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
                $stmt->execute(['name' => $name]);

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
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    Auth::requireAdmin();

    $id = $_GET['id'] ?? null;

    if ($id) {
        $pdo = Database::getPDO();

        // ⚠️ Optionnel : vérifier qu'aucun produit n'est lié à cette catégorie
        $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM products WHERE category_id = :id");
        $stmtCheck->execute(['id' => $id]);
        $count = $stmtCheck->fetchColumn();

        if ($count > 0) {
            $_SESSION['error'] = "Impossible de supprimer : cette catégorie contient des produits.";
        } else {
            $stmt = $pdo->prepare("DELETE FROM categories WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }
    }

    header('Location: /admin/categories');
    exit;
}

}
