<h2>Connexion</h2>

<?php if (!empty($error)) : ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="/connexion" class="auth-form">

    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </div>

</form>

<p class="auth-footer">
    Pas encore inscrit ? <a href="/inscription">Inscription</a>
</p>
