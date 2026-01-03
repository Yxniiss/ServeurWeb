<h2>Produits</h2>

<!-- Menu catégories -->
<nav class="categories-menu">
    <a href="/liste">Toutes</a>
    <?php foreach ($categories as $cat): ?>
        <a href="/liste?category=<?= $cat['id'] ?>"
           <?= isset($category_id) && $category_id == $cat['id'] ? 'style="font-weight:bold;"' : '' ?>>
            <?= htmlspecialchars($cat['name']) ?>
        </a>
    <?php endforeach; ?>
</nav>

<div class="products-grid">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <img src="/images/products/<?= htmlspecialchars($product['image']) ?>" 
                 alt="<?= htmlspecialchars($product['name']) ?>">
            <h3><?= htmlspecialchars($product['name']) ?></h3>
            <p><?= number_format($product['price'], 2, ',', ' ') ?> €</p>
            <a href="/products?id=<?= $product['id'] ?>">Voir</a>
            <a href="/panier/add?id=<?= $product['id'] ?>">Ajouter au panier</a>
        </div>
    <?php endforeach; ?>
</div>
