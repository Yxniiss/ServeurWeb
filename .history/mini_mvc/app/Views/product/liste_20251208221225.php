<h2>Liste des produits</h2>

<ul>
<?php foreach ($products as $product): ?>
    <li>
        <img src="/images/products/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="max-width:200px;">
        <strong><?= htmlspecialchars($product['name']) ?></strong> - <?= number_format($product['price'], 2, ',', ' ') ?> €
        <a href="/products?id=<?= $product['id'] ?>">Voir</a>
        <a href="/panier/add?id=<?= $product['id'] ?>">Ajouter au panier</a>
    </li>
<?php endforeach; ?>
</ul>
