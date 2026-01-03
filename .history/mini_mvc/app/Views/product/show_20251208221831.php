<div class="product-card">
    <div class="product-media">
        <img src="/images/products/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
    </div>
    <div class="product-body">
        <h2 class="product-name"><?= htmlspecialchars($product['name']) ?></h2>
        <p class="product-desc"><?= htmlspecialchars($product['description']) ?></p>
        <div class="product-meta">
            <span class="product-price"><?= number_format($product['price'], 2, ',', ' ') ?> €</span>
            <div class="product-actions">
                <a href="/panier/add?id=<?= $product['id'] ?>" class="btn btn-primary">Ajouter au panier</a>
                <a href="/liste" class="btn btn-outline">Retour à la liste</a>
            </div>
        </div>
    </div>
</div>
