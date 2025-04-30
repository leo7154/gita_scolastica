<?php
require_once 'models/Trip.php';

class TripController
{
    /**
     * Mostra l’elenco delle gite disponibili (per utenti normali).
     */
    public function list()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=user&action=login');
            exit;
        }

        // Se admin, reindirizza al pannello admin
        if ($_SESSION['user_role'] === 'admin') {
            header('Location: index.php?controller=admin&action=trips');
            exit;
        }

        $trips = Trip::getAll();
        include 'views/trips/list.php';
    }

    /**
     * Mostra i dettagli di una gita.
     */
    public function show()
    {
        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            echo "ID non valido.";
            return;
        }

        $trip = Trip::getById($id);
        $tours = Trip::getTours($id);
        $iscritti = Trip::countIscritti($id);
        $posti_disponibili = $trip['max_partecipanti'] - $iscritti;

        include 'views/trips/show.php';
    }

    /**
     * Iscrive l’utente a una gita con eventuali tour opzionali.
     */
    public function register()
    {
        global $dbh;

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=user&action=login');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $trip_id = $_GET['id'] ?? null;

        if (!$trip_id || !is_numeric($trip_id)) {
            echo "Gita non valida.";
            return;
        }

        // Verifica se già iscritto
        $stmt = $dbh->prepare("SELECT * FROM registrations WHERE user_id = ? AND trip_id = ?");
        $stmt->execute([$user_id, $trip_id]);
        if ($stmt->fetch()) {
            echo "Sei già iscritto a questa gita.";
            return;
        }

        // Inserisci registrazione
        $dbh->prepare("INSERT INTO registrations (user_id, trip_id, data_iscrizione) VALUES (?, ?, NOW())")
            ->execute([$user_id, $trip_id]);
        $registration_id = $dbh->lastInsertId();

        // Inserisci tour opzionali selezionati
        if (!empty($_POST['tours']) && is_array($_POST['tours'])) {
            foreach ($_POST['tours'] as $tour_id) {
                $dbh->prepare("INSERT INTO registration_tours (registration_id, tour_id) VALUES (?, ?)")
                    ->execute([$registration_id, $tour_id]);
            }
        }

        header("Location: index.php?controller=user&action=profile");
        exit;
    }

    /**
     * Mostra il form di recensione o salva una nuova recensione.
     */
    public function review()
    {
        global $dbh;

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=user&action=login");
            exit;
        }

        $trip_id = $_GET['id'] ?? null;
        $user_id = $_SESSION['user_id'];

        if (!$trip_id || !is_numeric($trip_id)) {
            echo "ID gita non valido.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $voto = (int) $_POST['voto'];
            $commento = trim($_POST['commento']);

            if ($voto < 1 || $voto > 5 || empty($commento)) {
                echo "Recensione non valida.";
                return;
            }

            $stmt = $dbh->prepare("INSERT INTO reviews (trip_id, user_id, voto, commento, data_recensione) VALUES (?, ?, ?, ?, NOW())");
            $stmt->execute([$trip_id, $user_id, $voto, $commento]);

            echo "Grazie per la tua recensione!";
        } else {
            include 'views/trips/review.php';
        }
    }

    /**
     * Annulla l’iscrizione a una gita e rimuove i relativi tour.
     */
    public function unregister()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=user&action=login');
            exit;
        }

        global $dbh;

        $user_id = $_SESSION['user_id'];
        $trip_id = $_GET['id'] ?? null;

        if (!$trip_id || !is_numeric($trip_id)) {
            echo "ID gita non valido.";
            return;
        }

        // Trova la registrazione
        $stmt = $dbh->prepare("SELECT id FROM registrations WHERE user_id = ? AND trip_id = ?");
        $stmt->execute([$user_id, $trip_id]);
        $reg = $stmt->fetch();

        if ($reg) {
            $registration_id = $reg['id'];

            // Elimina tour collegati
            $dbh->prepare("DELETE FROM registration_tours WHERE registration_id = ?")->execute([$registration_id]);

            // Elimina registrazione
            $dbh->prepare("DELETE FROM registrations WHERE id = ?")->execute([$registration_id]);
        }

        header("Location: index.php?controller=user&action=profile");
        exit;
    }
}
