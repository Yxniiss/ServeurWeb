
<h1>Login Page</h1>

<h1><?= $title ?></h1>

<form method="post" action="/connexion">
    <label>Email : <input type="email" name="email" required></label><br>
    <label>Mot de passe : <input type="password" name="password" required></label><br>
    <button type="submit">Se connecter</button>
</form>

<p>Pas encore inscrit ? <a href="/inscription">Inscription</a></p>
