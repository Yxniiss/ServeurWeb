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
                <h2 class="cart-item-name"><?= htmlspecialchars($item['name']) ?></h2>
                <p class="cart-price"><?= number_format($item['price'], 2, ',', ' ') ?> €</p>

                <div class="cart-quantity">
                    <form action="/panier/update" method="post" style="display:inline">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <input type="hidden" name="quantity" value="<?= max(1, $item['quantity'] - 1) ?>">
                        <button type="submit" class="qty-btn">−</button>
                    </form>

                <span class="qty-number"><?= $item['quantity'] ?></span>

                <form action="/panier/update" method="post" style="display:inline">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <input type="hidden" name="quantity" value="<?= $item['quantity'] + 1 ?>">
                    <button type="submit" class="qty-btn">+</button>
                </form>
            </div>


        </div>
    <?php endforeach; ?>

</div>

<div class="cart-footer">
    <p class="cart-total">
        Total : <strong><?= number_format($total, 2, ',', ' ') ?> €</strong>
    </p>

    <div class="cart-actions">
        <a href="/liste" class="btn btn-outline">Continuer les achats</a>
        <button class="btn btn-success">Passer commande</button>
    </div>
</div>

<?php endif; ?>
