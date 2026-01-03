<h1 class="admin-title">Ajouter un produit</h1>

<?php if (!empty($error)): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form action="/admin/products/create"
      method="POST"
      enctype="multipart/form-data"
      class="admin-form">

    <div class="form-group">
        <label for="name">Nom du produit</label>
        <input
            type="text"
            id="name"
            name="name"
            placeholder="Nom du produit"
            required
            value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
        >
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea
            id="description"
            name="description"
            placeholder="Description du produit"
            rows="5"
            required
        ><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
    </div>

    <div class="form-group">
        <label for="price">Prix (€)</label>
        <input
            type="number"
            id="price"
            name="price"
            step="0.01"
            placeholder="0.00"
            required
            value="<?= htmlspecialchars($_POST['price'] ?? '') ?>"
        >
    </div>

    <div class="form-group">
        <label for="category_id">Catégorie</label>
        <select name="category_id" id="category_id" required>
            <option value="">-- Choisir une catégorie --</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"
                    <?= (($_POST['category_id'] ?? '') == $cat['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image du produit</label>
        <input
            type="file"
            id="image"
            name="image"
            accept="image/*"
            required
        >
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            Ajouter le produit
        </button>

        <a href="/admin/products" class="btn btn-outline">
            Annuler
        </a>
    </div>

</form>
