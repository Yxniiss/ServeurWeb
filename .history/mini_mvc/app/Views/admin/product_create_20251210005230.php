<h1>Ajouter un produit</h1>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form action="" method="post" enctype="multipart/form-data">
    <label>Nom :</label><br>
    <input type="text" name="name" required><br><br>

    <label>Description :</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Prix :</label><br>
    <input type="number" name="price" step="0.01" required><br><br>

    <label>Image :</label><br>
    <input type="file" name="image" accept="image/*" required><br><br>

    <button type="submit" class="btn btn-cta">Ajouter</button>
</form>
