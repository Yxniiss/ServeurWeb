<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<h1><?= $title ?></h1>

<ul>
<?php foreach ($products as $product): ?>
    
    <li>
        <?= $product['name'] ?> - <?= $product['price'] ?> €
        <a href="/products?id=<?= $product['id'] ?>">Voir le produit</a>
    </li>
<?php endforeach; ?>
</ul>

