<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<h1>Panier Page</h1>

<h1><?= $title ?></h1>

<?php if (empty($cart)): ?>
    <p>Votre panier est vide.</p>
<?php else: ?>
    <ul>
        <?php foreach ($cart as $item): ?>
            <li>
                <?= $item['name'] ?> - <?= $item['price'] ?> € x <?= $item['quantity'] ?>
                <a href="/panier/remove?id=<?= $item['id'] ?>">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <p>
        Total :
        <?= number_format(array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)), 2, ',', ' ') ?> €
    </p>
<?php endif; ?>
<a href="/liste">Continuer vos achats</a>
