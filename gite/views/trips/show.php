<?php include 'views/partials/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Titolo gita -->
            <h2 class="card-title text-primary"><?= htmlspecialchars($trip['nome_meta']) ?></h2>
            <p class="card-text"><?= htmlspecialchars($trip['descrizione']) ?></p>

            <!-- Info gita -->
            <ul class="list-unstyled mt-3">
                <li><strong>📅 Data:</strong> <?= htmlspecialchars($trip['data']) ?></li>
                <li><strong>👥 Posti disponibili:</strong> <?= $posti_disponibili ?> / <?= $trip['max_partecipanti'] ?></li>
            </ul>
        </div>
    </div>

    <!-- Sezione tour opzionali -->
    <div class="mt-4">
        <?php if ($tours): ?>
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h4 class="mb-0">Tour Opzionali</h4>
                </div>
                <div class="card-body">
                    <!-- Form per l'iscrizione e selezione tour -->
                    <form method="POST" action="?controller=trip&action=register&id=<?= $trip['id'] ?>">
                        <?php foreach ($tours as $tour): ?>
                            <div class="form-check mb-2">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="tours[]" 
                                    value="<?= $tour['id'] ?>" 
                                    id="tour<?= $tour['id'] ?>"
                                >
                                <label class="form-check-label" for="tour<?= $tour['id'] ?>">
                                    <?= htmlspecialchars($tour['nome_tour']) ?> 
                                    (<?= $tour['durata'] ?>h) – 
                                    €<?= number_format($tour['costo_aggiuntivo'], 2) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>

                        <!-- Bottone di iscrizione -->
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-success">Iscriviti</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <!-- Messaggio se non ci sono tour -->
            <div class="alert alert-info mt-3" role="alert">
                Non ci sono tour opzionali per questa gita.
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'views/partials/footer.php'; ?>
