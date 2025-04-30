<?php
require_once __DIR__ . '/../config/database.php';

class User
{
    /**
     * Trova un utente tramite email
     * @param string $email
     * @return array|false
     */
    public static function findByEmail(string $email): array|false
    {
        global $dbh; // uso esplicito invece di $GLOBALS
        $stmt = $dbh->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crea un nuovo utente nel database
     * @param array $data
     * @return void
     */
    public static function create(array $data): void
    {
        global $dbh;

        // Inserimento sicuro con valori parametrizzati
        $stmt = $dbh->prepare("
            INSERT INTO users (nome, cognome, email, password_hash, ruolo)
            VALUES (?, ?, ?, ?, 'user')
        ");

        $stmt->execute([
            $data['nome'],
            $data['cognome'],
            $data['email'],
            $data['password_hash']
        ]);
    }
}
