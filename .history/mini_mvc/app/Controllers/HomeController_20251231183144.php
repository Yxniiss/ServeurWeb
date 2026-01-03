<?php

// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\User;

// Déclare la classe finale HomeController qui hérite de Controller
final class HomeController extends Controller
{
    // Déclare la méthode d'action par défaut qui ne retourne rien
    public function index()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM products WHERE is_bestseller = 1 ORDER BY id DESC");
        $bestSellers = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->render('home/index', [
            'bestSellers' => $bestSellers
        ]);
    }

    public function users(): void
    {
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('home/users', params: [
            // Définit le titre transmis à la vue
            'users' => $users = User::getAll(),
        ]);
    }
}