<?php
require_once 'models/Trip.php';

class AdminController
{
    /**
     * Verifica che l’utente sia admin.
     */
    private function ensureAdmin()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            http_response_code(403);
            exit('Accesso riservato.');
        }
    }

    /**
     * Mostra la dashboard di amministrazione.
     */
    public function dashboard()
    {
        $this->ensureAdmin();
        include 'views/admin/dashboard.php';
    }

    /**
     * Elenco di tutte le gite.
     */
    public function trips()
    {
        $this->ensureAdmin();
        $trips = Trip::getAll();
        include 'views/admin/trips.php';
    }

    /**
     * Crea una nuova gita.
     */
    public function newTrip()
    {
        $this->ensureAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Trip::create($_POST);
            header('Location: index.php?controller=admin&action=trips');
            exit;
        } else {
            $action = 'index.php?controller=admin&action=newTrip';
            include 'views/admin/trip_form.php';
        }
    }

    /**
     * Modifica una gita esistente e aggiunge eventuali tour.
     */
    public function editTrip()
    {
        $this->ensureAdmin();

        $trip_id = $_GET['id'] ?? null;
        if (!$trip_id || !is_numeric($trip_id)) {
            echo "ID gita non valido.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['save_trip'])) {
                Trip::update($trip_id, $_POST);
            } elseif (isset($_POST['add_tour'])) {
                Trip::addTour($trip_id, $_POST);
            }
            header("Location: index.php?controller=admin&action=editTrip&id=" . $trip_id);
            exit;
        }

        $trip = Trip::getById($trip_id);
        $tours = Trip::getTours($trip_id);
        $action = 'index.php?controller=admin&action=editTrip&id=' . $trip_id;
        include 'views/admin/trip_form.php';
    }

    /**
     * Elimina una gita.
     */
    public function deleteTrip()
    {
        $this->ensureAdmin();

        $id = $_GET['id'] ?? null;
        if ($id && is_numeric($id)) {
            Trip::delete($id);
        }
        header('Location: index.php?controller=admin&action=trips');
        exit;
    }

    /**
     * Elimina un tour opzionale da una gita.
     */
    public function deleteTour()
    {
        $this->ensureAdmin();

        $tour_id = $_GET['id'] ?? null;
        $trip_id = $_GET['trip'] ?? null;

        if ($tour_id && $trip_id && is_numeric($tour_id) && is_numeric($trip_id)) {
            Trip::deleteTour($tour_id);
        }

        header("Location: index.php?controller=admin&action=editTrip&id=" . $trip_id);
        exit;
    }
}
