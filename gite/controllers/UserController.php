<?php
require_once 'models/User.php';

class UserController
{
    /**
     * Mostra il modulo di login o autentica l’utente.
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = User::findByEmail($email);

            // Verifica credenziali
            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['ruolo'];
                header('Location: index.php');
                exit;
            } else {
                $error = "Credenziali errate.";
                include 'views/users/login.php';
            }
        } else {
            include 'views/users/login.php';
        }
    }

    /**
     * Termina la sessione utente.
     */
    public function logout()
    {
        session_destroy();
        header('Location: index.php');
    }

    /**
     * Mostra il modulo di registrazione o registra un nuovo utente.
     */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validazione di base
            if (empty($_POST['nome']) || empty($_POST['cognome']) || empty($_POST['email']) || empty($_POST['password'])) {
                $error = "Tutti i campi sono obbligatori.";
                include 'views/users/register.php';
                return;
            }

            // Preparazione dati
            $data = [
                'nome' => $_POST['nome'],
                'cognome' => $_POST['cognome'],
                'email' => $_POST['email'],
                'password_hash' => password_hash($_POST['password'], PASSWORD_BCRYPT)
            ];

            User::create($data);
            header('Location: index.php?controller=user&action=login');
            exit;
        } else {
            include 'views/users/register.php';
        }
    }

    /**
     * Mostra il profilo utente con elenco gite e tour.
     */
    public function profile()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=user&action=login');
            exit;
        }

        global $dbh;
        $user_id = $_SESSION['user_id'];

        // Dati utente
        $stmt = $dbh->prepare("SELECT nome, cognome, email FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $utente = $stmt->fetch();

        // Recupera gite + costo totale + tour associati
        $stmt = $dbh->prepare("
            SELECT 
                t.id AS trip_id,
                t.nome_meta,
                t.data,
                t.descrizione,
                t.costo_base,
                IFNULL(SUM(tr.cost), 0) AS totale_tour
            FROM trips t
            JOIN registrations r ON r.trip_id = t.id
            LEFT JOIN (
                SELECT rt.registration_id, rt.tour_id, tu.costo_aggiuntivo AS cost
                FROM registration_tours rt
                JOIN tours tu ON tu.id = rt.tour_id
            ) AS tr ON tr.registration_id = r.id
            WHERE r.user_id = ?
            GROUP BY t.id
            ORDER BY t.data ASC
        ");
        $stmt->execute([$user_id]);
        $gite = $stmt->fetchAll();

        // Associa tour specifici per ogni gita
        $tour_assoc = [];
        foreach ($gite as $gita) {
            $stmt = $dbh->prepare("
                SELECT tu.nome_tour, tu.costo_aggiuntivo
                FROM registration_tours rt
                JOIN registrations r ON r.id = rt.registration_id
                JOIN tours tu ON tu.id = rt.tour_id
                WHERE r.user_id = ? AND r.trip_id = ?
            ");
            $stmt->execute([$user_id, $gita['trip_id']]);
            $tour_assoc[$gita['trip_id']] = $stmt->fetchAll();
        }

        include 'views/users/profile.php';
    }
}
