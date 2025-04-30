<?php include 'views/partials/header.php'; ?>

<div class="container mt-5 mb-5">
    <!-- Titolo sezione -->
    <h2 class="text-primary mb-4">Gestione Gite</h2>

    <!-- Pulsante per aggiungere una nuova gita -->
    <a href="?controller=admin&action=newTrip" class="btn btn-success mb-3">
        + Nuova Gita
    </a>

    <!-- Tabella elenco gite -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Meta</th>
                    <th>Data</th>
                    <th class="text-center">Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trips as $trip): ?>
                    <tr>
                        <!-- Nome meta -->
                        <td><?= htmlspecialchars($trip['nome_meta']) ?></td>

                        <!-- Data -->
                        <td><?= htmlspecialchars($trip['data']) ?></td>

                        <!-- Azioni -->
                        <td class="text-center">
                            <a href="?controller=admin&action=editTrip&id=<?= $trip['id'] ?>" 
                               class="btn btn-sm btn-warning me-1">
                                Modifica
                            </a>
                            <a href="index.php?controller=admin&action=deleteTrip&id=<?= $trip['id'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Confermi eliminazione della gita?')">
                                Elimina
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'views/partials/footer.php'; ?>
