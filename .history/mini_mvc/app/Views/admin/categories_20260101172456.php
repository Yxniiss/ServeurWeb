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

<style>
/* Styles rapides pour l’admin, tu peux adapter ton CSS existant */
.admin-title {
    font-size: 1.8rem;
    margin-bottom: 1rem;
}

.admin-actions {
    margin-bottom: 1rem;
}

.btn {
    padding: 0.5rem 1rem;
    text-decoration: none;
    color: #fff;
    background-color: #4829E0;
    border-radius: 5px;
    margin-right: 0.5rem;
}

.btn-primary:hover {
    background-color: #3a21b8;
}

.btn-outline {
    background-color: #fff;
    color: #4829E0;
    border: 1px solid #4829E0;
}

.btn-outline:hover {
    background-color: #4829E0;
    color: #fff;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
}

.admin-table th,
.admin-table td {
    border: 1px solid #ddd;
    padding: 0.5rem;
    text-align: left;
}

.admin-table th {
    background-color: #f0f0f0;
}
</style>
