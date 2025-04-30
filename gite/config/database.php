<?php
// Configurazione parametri database
$host     = 'localhost';
$db       = 'gite_scolastiche';
$user     = 'root';
$pass     = '';
$charset  = 'utf8mb4';

// Opzioni di connessione PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Errori lanciati come eccezioni
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch come array associativo
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Usa prepared statement reali
];

try {
    // DSN: Data Source Name
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    // Connessione globale (se vuoi mantenerla così)
    global $dbh;
    $dbh = new PDO($dsn, $user, $pass, $options);

} catch (PDOException $e) {
    // Errore critico in connessione
    http_response_code(500);
    echo "Errore connessione al database.";
    // In produzione evita di esporre $e->getMessage()
    // error_log($e->getMessage()); // Puoi loggarlo in alternativa
    exit;
}
?>
