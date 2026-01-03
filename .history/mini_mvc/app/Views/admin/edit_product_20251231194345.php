<h1 class="admin-title">Modifier le produit</h1>

<a href="/admin/products" class="btn btn-outline admin-back">
    ← Retour à la liste
</a>

<?php if (!empty($error)) : ?>
    <div class="alert alert-error">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<form action="" method="post" enctype="multipart/form-data" class="admin-form">

    <!-- NOM -->
    <div class="form-group">
        <label for="name">Nom du produit</label>
        <input
            type="text"
            id="name"
            name="name"
            value="<?= htmlspecialchars($product['name'] ?? '') ?>"
            required
        >
    </div>

    <!-- DESCRIPTION -->
    <div class="form-group">
        <label for="description">Description</label>
        <textarea
            id="description"
            name="description"
            rows="5"
            required
        ><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
    </div>

    <!-- PRIX -->
    <div class="form-group">
        <label for="price">Prix (€)</label>
        <input
            type="number"
            id="price"
            name="price"
            step="0.01"
            value="<?= htmlspecialchars($product['price'] ?? 0) ?>"
            required
        >
    </div>

    <!-- IMAGE -->
    <div class="form-group">
        <label for="image">Image du produit</label>

        <?php if (!empty($product['image'])) : ?>
            <div class="current-image">
                <img
                    src="/images/products/<?= htmlspecialchars($product['image']) ?>"
                    alt="<?= htmlspecialchars($product['name']) ?>"
                    width="120"
                >
                <p class="hint">Image actuelle</p>
            </div>
        <?php endif; ?>

        <input type="file" name="image" id="image">
    </div>

    <!-- BEST SELLER -->
    <div class="form-group form-checkbox">
        <label>
            <input
                type="checkbox"
                name="is_best_seller"
                value="1"
                <?= !empty($product['is_best_seller']) ? 'checked' : '' ?>
            >
            Marquer comme best-seller
        </label>
    </div>

    <!-- ACTIONS -->
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            Enregistrer les modifications
        </button>
    </div>

</form>
