<h2>Liste des produits</h2>

<nav class="categories-menu">
    <a href="/liste" class="<?= !isset($_GET['category']) ? 'active' : '' ?>">Tous</a>
    <?php foreach ($categories as $cat): ?>
        <a href="/liste?category=<?= $cat['id'] ?>" 
           class="<?= (isset($_GET['category']) && $_GET['category'] == $cat['id']) ? 'active' : '' ?>">
           <?= htmlspecialchars($cat['name']) ?>
        </a>
    <?php endforeach; ?>
</nav>

<div class="product-list">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <div class="product-image">
                <img src="/images/products/<?= htmlspecialchars($product['image']) ?>" 
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
