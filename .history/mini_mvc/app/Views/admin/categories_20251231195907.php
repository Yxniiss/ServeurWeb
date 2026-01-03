<h1>Gestion des catégories</h1>

<a href="/admin/categories/create" class="btn btn-cta">Ajouter une catégorie</a>

<ul>
<?php foreach ($categories as $c): ?>
    <li><?= htmlspecialchars($c['name']) ?></li>
<?php endforeach; ?>
</ul>
