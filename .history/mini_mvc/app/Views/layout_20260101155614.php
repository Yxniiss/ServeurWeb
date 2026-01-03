<header>
    <div class="header-inner">
        <a href="/" class="brand">BasketStore</a>

        <!-- Nav à gauche -->
        <div class="nav-left">
            <a href="/liste">Tous les produits</a>

            <?php
            // Récupérer toutes les catégories pour le menu
            use Mini\Core\Database;
            $pdo = Database::getPDO();
            $categories = $pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
            $activeCategory = $_GET['category'] ?? null;
            ?>

            <?php foreach ($categories as $cat): ?>
                <a href="/liste?category=<?= $cat['id'] ?>"
                   <?= $cat['id'] == $activeCategory ? 'class="active"' : '' ?>>
                   <?= htmlspecialchars($cat['name']) ?>
                </a>
            <?php endforeach; ?>
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
