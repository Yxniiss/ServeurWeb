<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Basketball Store' ?></title>
    <!-- Ici tu peux ajouter ton CSS -->
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

<?php
// Démarrage sécurisé de la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Header -->
<header>
    <h1><?= isset($title) ? htmlspecialchars($title) : 'Basketball Store' ?></h1>

    <nav>
        <a href="/">Accueil</a>
        <a href="/liste">Produits</a>
        <a href="/panier">Panier</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <span>Bonjour, <?= htmlspecialchars($_SESSION['user_name'] ?? '') ?></span>
            <a href="/deconnexion">Déconnexion</a>
        <?php else: ?>
            <a href="/connexion">Connexion</a>
            <a href="/inscription">Inscription</a>
        <?php endif; ?>
    </nav>
</header>

<!-- Contenu principal -->
<main>
    <?= $content ?? '' ?>
</main>

<!-- Footer -->
<footer>
    <p>&copy; <?= date('Y') ?> Basketball Store</p>
</footer>

</body>
</html>
