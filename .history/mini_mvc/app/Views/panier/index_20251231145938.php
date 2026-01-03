<h1 class="cart-title">Votre panier</h1>

<?php if (empty($cart)): ?>
    <p class="cart-empty">Votre panier est vide.</p>
    <a href="/liste" class="btn btn-primary">Voir les produits</a>
<?php else: ?>

<div class="cart-container">

    <?php foreach ($cart as $item): ?>
        <div class="cart-item">

            <div class="cart-item-image">
                <img src="/images/products/<?= htmlspecialchars($item['image']) ?>" 
                     alt="<?= htmlspecialchars($item['name']) ?>">
            </div>

            <div class="cart-item-info">
                <h2><?= htmlspecialchars($item['name']) ?></h2>
                <p class="cart-price"><?= number_format($item['price'], 2, ',', ' ') ?> €</p>
                <p class="cart-qty">Quantité : <?= $item['quantity'] ?></p>

                <a href="/panier/remove?id=<?= $item['id'] ?>" class="btn btn-danger">
                    Supprimer
                </a>
            </div>

        </div>
    <?php endforeach; ?>

</div>

<div class="cart-footer">
    <p class="cart-total">
        Total : <strong><?= number_format($total, 2, ',', ' ') ?> €</strong>
    </p>

    <a href="/liste" class="btn btn-outline">Continuer mes achats</a>
</div>

<?php endif; ?>
