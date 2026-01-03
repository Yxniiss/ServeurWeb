<h2>Best Sellers</h2>
<div class="bestsellers">
    <?php foreach ($bestsellers as $product): ?>
        <div class="product-card">
            <img src="/images/products/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
            <h3><?= htmlspecialchars($product['name']) ?></h3>
            <p><?= number_format($product['price'], 2, ',', ' ') ?> €</p>
            <a href="/products?id=<?= $product['id'] ?>">Voir</a>
            <a href="/panier/add?id=<?= $product['id'] ?>">Ajouter au panier</a>
        </div>
    <?php endforeach; ?>
</div>
