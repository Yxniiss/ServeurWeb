<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<h1>show Page</h1>

<h1><?= $product['name'] ?></h1>

<h1><?= htmlspecialchars($product['name']) ?></h1>
<p><?= htmlspecialchars($product['description']) ?></p>
<p>Prix : <?= number_format($product['price'], 2, ',', ' ') ?> €</p>
<a href="/panier/add?id=<?= $product['id'] ?>">Ajouter au panier</a>
<a href="/liste">Retour à la liste des produits</a>

