<h1>Créer une catégorie</h1>

<?php if (!empty($error)): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form action="/admin/categories/create" method="POST" class="admin-form">
    <div class="form-group">
        <label for="name">Nom de la catégorie</label>
        <input type="text" name="name" id="name" placeholder="Nom de la catégorie" required>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="/admin/categories" class="btn btn-outline">Annuler</a>
    </div>
</form>
