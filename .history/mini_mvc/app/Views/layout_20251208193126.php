<!doctype html>
<!-- Définit la langue du document -->
<html lang="fr">
<!-- En-tête du document HTML -->
<head>
    <!-- Déclare l'encodage des caractères -->
    <meta charset="utf-8">
    <!-- Configure le viewport pour les appareils mobiles -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Définit le titre de la page avec échappement -->
    <title><?= isset($title) ? htmlspecialchars($title) : 'App' ?></title>
</head>
<!-- Corps du document -->
<body>
<!-- En-tête de la page -->
<header>
    <!-- Affiche le titre principal avec échappement -->
    <h1><?= isset($title) ? htmlspecialchars($title) : 'App' ?></h1>
    <?php session_start(); ?>
<nav>
    <a href="/liste">Produits</a>
    <a href="/panier">Panier</a>

    <?php if (isset($_SESSION['user_id'])): ?>
        <span>Bonjour, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
        <a href="/deconnexion">Déconnexion</a>
    <?php else: ?>
        <a href="/connexion">Connexion</a>
        <a href="/inscription">Inscription</a>
    <?php endif; ?>
</nav>
</header>
<!-- Zone de contenu principal -->
<main>
    <!-- Insère le contenu rendu de la vue -->
    <?= $content ?>
    
</main>
<!-- Fin du corps de la page -->
</body>
<!-- Fin du document HTML -->
</html>

