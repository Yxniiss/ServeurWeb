<?php

declare(strict_types=1);

namespace Mini\Models;

use Mini\Core\Database;
use PDO;
use Mini\Core\Model;

class User extends Model
{
    /**
     * Récupère un utilisateur par son email
     */
    public static function getByEmail(string $email): ?array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    /**
     * Crée un nouvel utilisateur et retourne son ID
     */
    public static function create(string $username, string $email, string $password): int
    {
        $pdo = Database::getPDO();
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("
            INSERT INTO users (username, email, password) 
            VALUES (:username, :email, :password)
        ");
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hash
        ]);

        return (int)$pdo->lastInsertId();
    }
}
