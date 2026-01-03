<?php if (!empty($cart)): ?>
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
        <td>
            <form action="/panier/update" method="post" style="display:inline;">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="0" style="width:50px;">
                <button type="submit">OK</button>
            </form>
        </td>
        <td>
            <a href="/panier/remove?id=<?= $item['id'] ?>">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<p><strong>Total : <?= number_format($total, 2, ',', ' ') ?> €</strong></p>
<?php endif; ?>
