<h1>Modifier le produit</h1>

<?php if(isset($error)) : ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form action="" method="post" enctype="multipart/form-data">
    <label>Nom :</label>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name'] ?? '') ?>" required><br>

    <label>Description :</label>
    <textarea name="description" required><?= htmlspecialchars($product['description'] ?? '') ?></textarea><br>

    <label>Prix :</label>
    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price'] ?? 0) ?>" required><br>

    <label>Image :</label>
    <input type="file" name="image"><br>
    <?php if(!empty($product['image'])): ?>
        <img src="/images/products/<?= htmlspecialchars($product['image']) ?>" alt="" width="100">
    <?php endif; ?>

    <label>
    <input type="checkbox" name="is_bestseller" value="1" <?= $product['is_bestseller'] ? 'checked' : '' ?>>
    Best seller
</label>



    <button type="submit">Modifier</button>
</form>

<a href="/admin/products">Retour à la liste</a>
