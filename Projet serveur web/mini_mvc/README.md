Mini MVC - Installer et lancer le projet

Ce dépôt contient une mini-application PHP (Mini MVC). Ce fichier décrit comment installer la base de données, configurer l'application, lancer le serveur et utiliser des identifiants de test.

**Prérequis**
- **PHP** 7.4+ installé
- **MySQL** ou MariaDB (ou tout autre client compatible .sql)
- **Composer** (optionnel si le dossier `vendor/` existe déjà)

**1 Installer la base de données**

Le fichier SQL se trouve à la racine du projet: `basketball_store.sql`.

Méthode (ligne de commande MySQL) :

1. Créer la base (si nécessaire) ou laisser le script créer les tables :

```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS basketball_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p basketball_store < basketball_store.sql
```

Si votre utilisateur MySQL `root` n'a pas de mot de passe, utilisez `-u root basketball_store < basketball_store.sql` (sans `-p`).

Vous pouvez aussi importer `basketball_store.sql` via un outil graphique (phpMyAdmin, MySQL Workbench, DBeaver) en important le fichier dans la base `basketball_store`.

**2. Configurer l'accès à la base**

Les paramètres de connexion sont dans `app/config.ini`.
Par défaut (valeurs présentes) :

- `DB_NAME = "basketball_store"`
- `DB_HOST = "127.0.0.1"`
- `DB_USERNAME = "root"`
- `DB_PASSWORD = ""`

Si vous avez modifié l'utilisateur, le mot de passe ou le nom de base, mettez à jour `app/config.ini` en conséquence.

**3. Installer les dépendances (optionnel)**

Si le dossier `vendor/` n'existe pas ou si vous voulez mettre à jour les dépendances :

```bash
composer install
```

**4. Lancer le projet en local**

Utilisez le serveur PHP intégré depuis la racine du projet :

```bash
php -S localhost:8000 -t public
```

Ouvrez ensuite `http://localhost:8000` dans votre navigateur.

Si vous utilisez Apache/Nginx, pointez le DocumentRoot vers le dossier `public/`.

**5. Identifiants de test**

- **Email** : drif8907@gmail.com
- **Mot de passe / code** : 1234

Utilisez ces identifiants via la page de connexion (`/auth/login` ou via l'interface d'accueil selon le projet).

**Notes / dépannage rapide**
- Si vous avez une erreur de connexion à la base, vérifiez `app/config.ini` et que la base `basketball_store` existe.
- Pour afficher les erreurs PHP en développement, activez l'affichage d'erreurs dans votre `php.ini` ou ajoutez temporairement `ini_set('display_errors', 1); error_reporting(E_ALL);` dans `public/index.php` pour déboguer.

