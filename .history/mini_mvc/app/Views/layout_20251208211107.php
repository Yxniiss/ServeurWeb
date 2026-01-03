<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Basketball Store' ?></title>
    <!-- Ici tu peux ajouter ton CSS -->
    <link rel="stylesheet" href="/style.css">

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
    <div class="header-inner">
        <a href="/" class="brand">BasketStore</a>

        <!-- Nav à gauche -->
        <div class="nav-left">
            <a href="/liste">Produits</a>
            <a href="/panier">Panier</a>
        </div>

        <!-- Auth / pseudo à droite -->
        <div class="nav-right">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="user-name"><?= htmlspecialchars($_SESSION['user_name'] ?? '') ?></span>
                <button class="auth-btn logout" onclick="window.location.href='/deconnexion'">Déconnexion</button>
            <?php else: ?>
                <button class="auth-btn login" onclick="window.location.href='/connexion'">Connexion</button>
                <button class="auth-btn login" onclick="window.location.href='/inscription'">Inscription</button>
            <?php endif; ?>
        </div>
    </div>
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
