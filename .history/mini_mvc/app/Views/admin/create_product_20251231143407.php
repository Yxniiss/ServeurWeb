<form action="/admin/products/create" method="POST" enctype="multipart/form-data">

    <label>Nom</label>
    <input type="text" name="name" required>

    <label>Description</label>
    <textarea name="description" required></textarea>

    <label>Prix</label>
    <input type="number" step="0.01" name="price" required>

    <label>Image</label>
    <input type="file" name="image" accept="image/*" required>

    <button type="submit">Ajouter</button>
</form>
