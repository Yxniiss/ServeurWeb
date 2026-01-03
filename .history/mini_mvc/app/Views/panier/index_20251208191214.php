<h1><?= $title ?></h1>

<?php if (empty($cart)): ?>
    <p>Votre panier est vide.</p>
<?php else: ?>
    <ul>
        <?php foreach ($cart as $item): ?>
            <li>
                <?= htmlspecialchars($item['name']) ?> - 
                <?= number_format($item['price'], 2, ',', ' ') ?> € x <?= $item['quantity'] ?>
                <a href="/panier/remove?id=<?= $item['id'] ?>">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <p><strong>Total : <?= number_format($total, 2, ',', ' ') ?> €</strong></p>
<?php endif; ?>

<a href="/liste">Retour à la liste des produits</a>
