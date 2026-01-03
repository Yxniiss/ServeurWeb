<?php
// admin/categories.php
$title = "Gestion des catégories";
?>

<h1 class="admin-title">Gestion des catégories</h1>

<div class="admin-actions">
    <a href="/admin/categories/create" class="btn btn-primary">Créer une nouvelle catégorie</a>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom de la catégorie</th>
            <th>Actions</th> <!-- Nouvelle colonne pour les actions -->
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?= $cat['id'] ?></td>
                    <td><?= htmlspecialchars($cat['name']) ?></td>
                    <td>
                        <!-- Bouton supprimer -->
                        <a href="/admin/categories/delete?id=<?= $cat['id'] ?>"
                           onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')"
                           class="btn btn-outline">
                           Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Aucune catégorie disponible.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

