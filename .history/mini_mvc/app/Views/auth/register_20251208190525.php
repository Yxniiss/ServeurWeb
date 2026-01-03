<h1>register Page</h1>

<h1><?= $title ?></h1>

<form method="post" action="/inscription">
    <label>Email : <input type="email" name="email" required></label><br>
    <label>Mot de passe : <input type="password" name="password" required></label><br>
    <button type="submit">S’inscrire</button>
</form>

<p>Déjà inscrit ? <a href="/connexion">Connexion</a></p>
