<?php include 'views/partials/header.php'; ?>

<div class="container mt-5 mb-5">
    <!-- Titolo dinamico -->
    <h2 class="mb-4"><?= isset($trip) ? 'Modifica Gita' : 'Nuova Gita' ?></h2>

    <!-- Form per creare/modificare una gita -->
    <form method="post" action="<?= $action ?>" class="border rounded p-4 shadow-sm bg-light mb-5">
        <input type="hidden" name="save_trip" value="1">

        <!-- Campo Nome Meta -->
        <div class="mb-3">
            <label class="form-label">Nome Meta</label>
            <input type="text" name="nome_meta" class="form-control" value="<?= htmlspecialchars($trip['nome_meta'] ?? '') ?>" required>
        </div>

        <!-- Campo Descrizione -->
        <div class="mb-3">
            <label class="form-label">Descrizione</label>
            <textarea name="descrizione" class="form-control" required><?= htmlspecialchars($trip['descrizione'] ?? '') ?></textarea>
        </div>

        <!-- Campo Data -->
        <div class="mb-3">
            <label class="form-label">Data</label>
            <input type="date" name="data" class="form-control" value="<?= $trip['data'] ?? '' ?>" required>
        </div>

        <!-- Campo Costo Base -->
        <div class="mb-3">
            <label class="form-label">Costo Base (€)</label>
            <input type="number" name="costo_base" class="form-control" step="0.01" value="<?= $trip['costo_base'] ?? '' ?>" required>
        </div>

        <!-- Campo Max Partecipanti -->
        <div class="mb-4">
            <label class="form-label">Max Partecipanti</label>
            <input type="number" name="max_partecipanti" class="form-control" value="<?= $trip['max_partecipanti'] ?? '' ?>" required>
        </div>

        <!-- Pulsante Salva Gita -->
        <button type="submit" class="btn btn-primary">Salva Gita</button>
    </form>

    <!-- Sezione Tour opzionali -->
    <h4 class="mb-3">Tour Opzionali</h4>

    <?php if (!empty($tours)): ?>
        <ul class="list-group mb-4">
            <?php foreach ($tours as $tour): ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div>
                        <strong><?= htmlspecialchars($tour['nome_tour']) ?></strong> (<?= htmlspecialchars($tour['durata']) ?>h)
                        <br><?= htmlspecialchars($tour['descrizione']) ?>
                        <br><span class="text-muted">Costo: €<?= number_format($tour['costo_aggiuntivo'], 2) ?></span>
                    </div>
                    <a href="index.php?controller=admin&action=deleteTour&id=<?= $tour['id'] ?>&trip=<?= $trip['id'] ?>" 
                       class="btn btn-sm btn-outline-danger"
                       onclick="return confirm('Eliminare questo tour?')">Elimina</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="text-muted">Nessun tour aggiunto.</p>
    <?php endif; ?>

    <!-- Form per aggiungere un nuovo tour -->
    <form method="post" action="<?= $action ?>" class="border rounded p-4 shadow-sm bg-light">
        <input type="hidden" name="add_tour" value="1">
        <h5 class="mb-3">Aggiungi Nuovo Tour</h5>

        <div class="mb-3">
            <label class="form-label">Nome Tour</label>
            <input type="text" name="nome_tour" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descrizione</label>
            <textarea name="descrizione" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Durata (ore)</label>
            <input type="number" name="durata" class="form-control" step="0.5" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Costo aggiuntivo (€)</label>
            <input type="number" name="costo_aggiuntivo" class="form-control" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-success">Aggiungi Tour</button>
    </form>

    <!-- Link per tornare alla lista -->
    <div class="mt-4">
        <a href="index.php?controller=admin&action=trips" class="btn btn-secondary">Torna alla lista gite</a>
    </div>
</div>

<?php include 'views/partials/footer.php'; ?>
