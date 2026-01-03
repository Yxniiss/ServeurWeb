<h2>Connexion</h2>

<?php if (!empty($error)): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="/connexion">
    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required>

    <button type="submit">Se connecter</button>
</form>

<p>Pas encore inscrit ? <a href="/inscription">Inscription</a></p>
