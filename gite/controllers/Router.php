<?php

class Router
{
    public function handleRequest()
    {
        // Recupera controller e action dalla query string o imposta valori predefiniti
        $controllerName = $_GET['controller'] ?? 'trip';
        $action = $_GET['action'] ?? 'list';

        // Sicurezza: impedisce nomi di controller con caratteri strani
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $controllerName) || !preg_match('/^[a-zA-Z0-9_]+$/', $action)) {
            echo "Richiesta non valida.";
            return;
        }

        // Costruisce nome del file e della classe
        $controllerFile = 'controllers/' . ucfirst($controllerName) . 'Controller.php';
        $className = ucfirst($controllerName) . 'Controller';

        // Verifica esistenza del file del controller
        if (!file_exists($controllerFile)) {
            http_response_code(404);
            echo "Controller '$controllerName' non trovato.";
            return;
        }

        require_once $controllerFile;

        // Verifica esistenza della classe
        if (!class_exists($className)) {
            http_response_code(500);
            echo "Classe controller '$className' non definita.";
            return;
        }

        $controller = new $className();

        // Verifica esistenza del metodo richiesto
        if (!method_exists($controller, $action)) {
            http_response_code(404);
            echo "Metodo '$action' non trovato nel controller '$className'.";
            return;
        }

        // Esegue l'azione richiesta
        $controller->$action();
    }
}
