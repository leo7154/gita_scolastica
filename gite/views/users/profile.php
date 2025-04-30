<?php include 'views/partials/header.php'; ?>

<div class="container mt-5">

    <!-- Sezione profilo utente -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Profilo Utente</h3>
        </div>
        <div class="card-body">
            <p><strong>Nome:</strong> <?= htmlspecialchars($utente['nome']) ?></p>
            <p><strong>Cognome:</strong> <?= htmlspecialchars($utente['cognome']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($utente['email']) ?></p>
        </div>
    </div>

    <!-- Sezione gite iscritte -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0">Le mie gite iscritte</h4>
        </div>
        <div class="card-body">
            <?php if ($gite): ?>
                <ul class="list-group">
                    <?php foreach ($gite as $gita): ?>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="mb-1"><?= htmlspecialchars($gita['nome_meta']) ?></h5>
                                    <p class="mb-1">📅 <strong>Data:</strong> <?= htmlspecialchars($gita['data']) ?></p>
                                    <p class="mb-1"><em><?= htmlspecialchars($gita['descrizione']) ?></em></p>
                                    <p class="mb-1">💰 <strong>Prezzo totale:</strong> €<?= number_format($gita['costo_base'] + $gita['totale_tour'], 2) ?></p>

                                    <?php if (!empty($tour_assoc[$gita['trip_id']])): ?>
                                        <p class="mt-2 mb-1"><strong>Attività extra:</strong></p>
                                        <ul class="ps-4">
                                            <?php foreach ($tour_assoc[$gita['trip_id']] as $tour): ?>
                                                <li>
                                                    <?= htmlspecialchars($tour['nome_tour']) ?> – 
                                                    €<?= number_format($tour['costo_aggiuntivo'], 2) ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>

                                <!-- Pulsante annulla -->
                                <div class="text-end">
                                    <a href="index.php?controller=trip&action=unregister&id=<?= $gita['trip_id'] ?>"
                                       class="btn btn-outline-danger btn-sm"
                                       onclick="return confirm('Sei sicuro di voler annullare l’iscrizione?');">
                                       Annulla
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted">Non sei ancora iscritto a nessuna gita.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Pulsante per nuove iscrizioni -->
    <div class="text-center mt-4">
        <a href="index.php?controller=trip&action=list" class="btn btn-primary">
            Iscriviti ad altre gite
        </a>
    </div>

</div>

<?php include 'views/partials/footer.php'; ?>
