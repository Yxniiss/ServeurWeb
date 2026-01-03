<?php

// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Core\Database;

// Déclare la classe finale HomeController qui hérite de Controller
final class HomeController extends Controller
{
    // Déclare la méthode d'action par défaut qui ne retourne rien
    public function index()
{
    $pdo = Database::getPDO();
    $stmt = $pdo->query("SELECT * FROM products WHERE is_best_seller = 1");
    $bestsellers = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    $this->render('home/index', ['bestsellers' => $bestsellers]);
}
}