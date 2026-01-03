<h1>Gestion des catégories</h1>

<a href="/admin/categories/create" class="btn btn-cta">Créer une catégorie</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $cat): ?>
            <tr>
                <td><?= $cat['id'] ?></td>
                <td><?= htmlspecialchars($cat['name']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
