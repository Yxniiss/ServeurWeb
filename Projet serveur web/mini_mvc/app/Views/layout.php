<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Basketball Store' ?></title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentUri = $_SERVER['REQUEST_URI'];
?>

<header>
    <div class="header-inner">
        <a href="/" class="brand">BasketStore</a>

        <div class="nav-left">
            <a href="/liste">Produits</a>
            <a href="/panier">Panier</a>
        </div>

        <div class="nav-right">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="user-name"><?= htmlspecialchars($_SESSION['user_name'] ?? '') ?></span>

                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1 && !str_starts_with($currentUri, '/admin')): ?>
                    <button class="auth-btn dashboard" onclick="window.location.href='/admin'">Dashboard</button>
                <?php endif; ?>

                <button class="auth-btn logout" onclick="window.location.href='/deconnexion'">Déconnexion</button>
            <?php else: ?>
                <button class="auth-btn login" onclick="window.location.href='/connexion'">Connexion</button>
                <button class="auth-btn login" onclick="window.location.href='/inscription'">Inscription</button>
            <?php endif; ?>
        </div>
    </div>
</header>

<main>
    <?= $content ?? '' ?>
</main>

<footer>
    <p>&copy; <?= date('Y') ?> BasketStore</p>
</footer>

</body>
</html>
