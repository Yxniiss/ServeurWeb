<h1 class="admin-title">Gestion des produits</h1>

<div class="admin-header">
    <a href="/admin/products/create" class="btn btn-primary">
        + Ajouter un produit
    </a>
</div>

<?php if (empty($products)) : ?>
    <p class="admin-empty">Aucun produit pour le moment.</p>
<?php else : ?>

<div class="admin-table-wrapper">
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produit</th>
                <th>Prix</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($products as $p) : ?>
            <tr>
                <td>#<?= $p['id'] ?></td>

                <td>
                    <strong><?= htmlspecialchars($p['name']) ?></strong>
                </td>

                <td>
                    <?= number_format($p['price'], 2, ',', ' ') ?> €
                </td>

                <td>
                    <?php if (!empty($p['image'])) : ?>
                        <img
                            src="/images/products/<?= htmlspecialchars($p['image']) ?>"
                            alt="<?= htmlspecialchars($p['name']) ?>"
                            width="60"
                        >
                    <?php else : ?>
                        —
                    <?php endif; ?>
                </td>

                <td class="admin-actions">
                    <a href="/admin/products/edit?id=<?= $p['id'] ?>" class="btn btn-outline">
                        Modifier
                    </a>

                    <a href="/admin/products/delete?id=<?= $p['id'] ?>"
                       class="btn btn-danger"
                       onclick="return confirm('Supprimer ce produit ?')">
                        Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php endif; ?>
