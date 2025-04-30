<?php

declare(strict_types=1);

// Avvia la sessione
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Autoload delle classi (se usi Composer, altrimenti modifica in base al tuo autoloader)
require_once __DIR__ . '/controllers/Router.php';

try {
    // Istanzia il router e gestisci la richiesta
    $router = new Router();
    $router->handleRequest();
} catch (Throwable $e) {
    // Gestione errori generica
    http_response_code(500);
    echo 'Si è verificato un errore: ' . htmlspecialchars($e->getMessage());
}
