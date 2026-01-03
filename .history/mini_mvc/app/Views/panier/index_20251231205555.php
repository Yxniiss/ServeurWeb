<h1 class="cart-title">Votre panier</h1>

<?php if (empty($cart)): ?>
    <p class="cart-empty">Votre panier est vide.</p>
    <a href="/liste" class="btn btn-primary">Voir les produits</a>
<?php else: ?>

<div class="cart-container">

    <?php foreach ($cart as $item): ?>
        <div class="cart-item">

            <!-- Image du produit -->
            <div class="cart-item-image">
                <img src="/public/images/products/<?= htmlspecialchars($item['image']) ?>"
                     alt="<?= htmlspecialchars($item['name']) ?>">
            </div>

            <!-- Infos du produit -->
            <div class="cart-item-info">
                <h2 class="cart-item-name"><?= htmlspecialchars($item['name']) ?></h2>
                <p class="cart-price"><?= number_format($item['price'], 2, ',', ' ') ?> €</p>

                <!-- Gestion de la quantité -->
                <div class="cart-quantity">
                    <a href="/panier/remove?id=<?= $item['id'] ?>" class="qty-btn">−</a>
                    <span class="qty-number"><?= $item['quantity'] ?></span>
                    <a href="/panier/add?id=<?= $item['id'] ?>" class="qty-btn">+</a>
                </div>

                <!-- Supprimer l'article -->
                <a href="/panier/remove?id=<?= $item['id'] ?>&all=1" class="remove-link">
                    Supprimer l’article
                </a>
            </div>

        </div>
    <?php endforeach; ?>

</div>

<!-- Footer du panier -->
<div class="cart-footer">
    <p class="cart-total">
        Total : <strong><?= number_format($total, 2, ',', ' ') ?> €</strong>
    </p>

    <div class="cart-actions">
        <a href="/liste" class="btn btn-outline">Continuer les achats</a>
        <a href="/commande" class="btn btn-success">Passer commande</a>
    </div>
</div>

<?php endif; ?>
