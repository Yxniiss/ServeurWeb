
<img src="/images/products/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="max-width:200px;">
<h2><?= htmlspecialchars($product['name']) ?></h2>

<p><?= htmlspecialchars($product['description']) ?></p>
<p>Prix : <?= number_format($product['price'], 2, ',', ' ') ?> €</p>

<a href="/panier/add?id=<?= $product['id'] ?>">Ajouter au panier</a>
<a href="/liste">Retour à la liste</a>
