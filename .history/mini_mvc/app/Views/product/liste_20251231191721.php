<h2>Liste des produits</h2>

<div class="product-list">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <div class="product-image">
                <img src="/images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
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
