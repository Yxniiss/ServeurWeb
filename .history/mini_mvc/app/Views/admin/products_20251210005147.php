<h1>Gestion des produits</h1>

<a href="/admin/products/create" class="btn btn-cta">Ajouter un produit</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= number_format($p['price'], 2, ',', ' ') ?> €</td>
            <td><img src="/images/products/<?= htmlspecialchars($p['image']) ?>" width="60"></td>
            <td>
                <a href="/admin/products/edit?id=<?= $p['id'] ?>" class="btn btn-outline">Modifier</a>
                <a href="/admin/products/delete?id=<?= $p['id'] ?>" class="btn btn-outline" onclick="return confirm('Supprimer ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
