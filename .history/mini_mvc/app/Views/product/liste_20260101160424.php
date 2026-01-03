<h2>
    <?php if (isset($_GET['category'])): ?>
        <?php
        // Chercher le nom de la catégorie sélectionnée
        $selectedCat = null;
        foreach ($categories as $cat) {
            if ($cat['id'] == $_GET['category']) {
                $selectedCat = $cat['name'];
                break;
            }
        }
        ?>
        <?= $selectedCat ? 'Produits - ' . htmlspecialchars($selectedCat) : 'Liste des produits' ?>
    <?php else: ?>
        Liste des produits
    <?php endif; ?>
</h2>

<!-- Menu catégories -->
<nav class="categories-menu">
    <a href="/liste" class="<?= !isset($_GET['category']) ? 'active' : '' ?>">Tous</a>
    <?php foreach ($categories as $cat): ?>
        <a href="/liste?category=<?= $cat['id'] ?>" 
           class="<?= (isset($_GET['category']) && $_GET['category'] == $cat['id']) ? 'active' : '' ?>">
           <?= htmlspecialchars($cat['name']) ?>
        </a>
    <?php endforeach; ?>
</nav>

<?php if (empty($products)): ?>
    <p>Aucun produit trouvé dans cette catégorie.</p>
<?php else: ?>
    <div class="product-list">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="/images/<?= htmlspecialchars($product['image']) ?>" 
                         alt="<?= htmlspecialchars($product['name']) ?>">
                </div>
                <div class="product-info">
                    <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>
                    <p class="product-price"><?= number_format($product['price'], 2, ',', ' ') ?> €</p>
                    <div class="product-actions">
                        <a href="/products?id=<?= $product['id'] ?>" class="btn btn-view">Voir</a>
                        <a href="/panier/add?id=<?= $product['id'] ?>" class="btn btn-add">Ajouter au panier</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
