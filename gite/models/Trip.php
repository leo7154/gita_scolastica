<?php
require_once __DIR__ . '/../config/database.php';

class Trip
{
    /**
     * Restituisce tutte le gite ordinate per data.
     */
    public static function getAll(): array
    {
        global $dbh;
        $stmt = $dbh->query("SELECT * FROM trips ORDER BY data ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Restituisce i dettagli di una gita tramite ID.
     */
    public static function getById(int $id): array|false
    {
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM trips WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Conta il numero di iscritti a una gita.
     */
    public static function countIscritti(int $trip_id): int
    {
        global $dbh;
        $stmt = $dbh->prepare("SELECT COUNT(*) as tot FROM registrations WHERE trip_id = ?");
        $stmt->execute([$trip_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) ($row['tot'] ?? 0);
    }

    /**
     * Crea una nuova gita.
     */
    public static function create(array $data): void
    {
        global $dbh;
        $stmt = $dbh->prepare("
            INSERT INTO trips (nome_meta, descrizione, data, costo_base, max_partecipanti)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['nome_meta'],
            $data['descrizione'],
            $data['data'],
            $data['costo_base'],
            $data['max_partecipanti']
        ]);
    }

    /**
     * Elimina una gita tramite ID.
     */
    public static function delete(int $id): void
    {
        global $dbh;
        $stmt = $dbh->prepare("DELETE FROM trips WHERE id = ?");
        $stmt->execute([$id]);
    }

    /**
     * Aggiunge un tour opzionale a una gita.
     */
    public static function addTour(int $trip_id, array $data): void
    {
        global $dbh;
        $stmt = $dbh->prepare("
            INSERT INTO tours (trip_id, nome_tour, descrizione, durata, costo_aggiuntivo)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $trip_id,
            $data['nome_tour'],
            $data['descrizione'],
            $data['durata'],
            $data['costo_aggiuntivo']
        ]);
    }

    /**
     * Restituisce tutti i tour associati a una gita.
     */
    public static function getTours(int $trip_id): array
    {
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM tours WHERE trip_id = ?");
        $stmt->execute([$trip_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Elimina un tour opzionale tramite ID.
     */
    public static function deleteTour(int $id): void
    {
        global $dbh;
        $stmt = $dbh->prepare("DELETE FROM tours WHERE id = ?");
        $stmt->execute([$id]);
    }

    /**
     * Aggiorna i dettagli di una gita.
     */
    public static function update(int $id, array $data): void
    {
        global $dbh;
        $stmt = $dbh->prepare("
            UPDATE trips
            SET nome_meta = ?, descrizione = ?, data = ?, costo_base = ?, max_partecipanti = ?
            WHERE id = ?
        ");
        $stmt->execute([
            $data['nome_meta'],
            $data['descrizione'],
            $data['data'],
            $data['costo_base'],
            $data['max_partecipanti'],
            $id
        ]);
    }
}
