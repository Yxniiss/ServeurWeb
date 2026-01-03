<h2>Inscription</h2>

<?php if (!empty($error)): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="/inscription">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" name="username" id="username" required>

    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required>

    <button type="submit">S'inscrire</button>
</form>

<p>Déjà inscrit ? <a href="/connexion">Connexion</a></p>
