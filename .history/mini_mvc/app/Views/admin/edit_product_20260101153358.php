<h1 class="admin-title">Modifier le produit</h1>

<?php if (!empty($error)): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" class="admin-form">

    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" id="name" name="name"
               value="<?= htmlspecialchars($product['name']) ?>" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5" required><?= htmlspecialchars($product['description']) ?></textarea>
    </div>

    <div class="form-group">
        <label for="price">Prix (€)</label>
        <input type="number" id="price" name="price" step="0.01"
               value="<?= htmlspecialchars($product['price']) ?>" required>
    </div>

    <div class="form-group">
        <label for="category_id">Catégorie</label>
        <select name="category_id" id="category_id" required>
            <option value="">-- Choisir une catégorie --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"
                    <?= ($cat['id'] == $product['category_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image">
        <img src="/images/products/<?= htmlspecialchars($product['image']) ?>" width="80">
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="is_best_seller" value="1"
                <?= $product['is_best_seller'] ? 'checked' : '' ?>>
            Best seller
        </label>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="/admin/products" class="btn btn-outline">Retour</a>
    </div>

</form>
