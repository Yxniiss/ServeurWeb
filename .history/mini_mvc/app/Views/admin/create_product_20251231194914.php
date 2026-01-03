<h1 class="admin-title">Ajouter un produit</h1>

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
        ></textarea>
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
        >
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
