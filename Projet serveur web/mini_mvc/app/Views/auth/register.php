<h2>Inscription</h2>

<?php if (!empty($error)) : ?>
    <p class="auth-error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="/inscription" class="auth-form">

    <div class="form-group">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" required>
    </div>

    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </div>

</form>

<p class="auth-footer">
    Déjà inscrit ? <a href="/connexion">Connexion</a>
</p>
