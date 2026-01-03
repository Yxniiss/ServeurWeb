<h2>Best Sellers</h2>

<div class="bestsellers-container">

    <?php foreach ($bestsellers as $product): ?>
        <div class="product-card">

            <!-- Image du produit -->
            <div class="product-media">
                <img src="/images/products/<?= htmlspecialchars($product['image']) ?>" 
                     alt="<?= htmlspecialchars($product['name']) ?>">
            </div>

            <!-- Infos produit -->
            <div class="product-body">
                <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>
                <p class="product-price"><?= number_format($product['price'], 2, ',', ' ') ?> €</p>

                <!-- Actions -->
                <div class="product-actions">
                    <a href="/products?id=<?= $product['id'] ?>" class="btn btn-outline">Voir</a>
                    <a href="/panier/add?id=<?= $product['id'] ?>" class="btn btn-primary">Ajouter au panier</a>
                </div>
            </div>

        </div>
    <?php endforeach; ?>

</div>
