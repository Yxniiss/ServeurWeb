<?php if (empty($cart)): ?>
    <p>Votre panier est vide.</p>
<?php else: ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Produit</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($cart as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['name']) ?></td>
            <td><?= number_format($item['price'], 2, ',', ' ') ?> €</td>
            <td><?= $item['quantity'] ?></td>
            <td>
                <a href="/panier/remove?id=<?= $item['id'] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <p><strong>Total : <?= number_format($total, 2, ',', ' ') ?> €</strong></p>
<?php endif; ?>

<a href="/liste">Retour aux produits</a>
