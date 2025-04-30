<?php include 'views/partials/header.php'; ?>

<div class="container mt-5 mb-5">
    <h2 class="text-primary mb-4">Le mie gite</h2>

    <?php if ($gite): ?>
        <!-- Lista gite iscritte -->
        <div class="row row-cols-1 g-4">
            <?php foreach ($gite as $gita): ?>
                <div class="col">
                    <!-- Card per ogni gita -->
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <!-- Nome e data -->
                            <h5 class="card-title">
                                <?= htmlspecialchars($gita['nome_meta']) ?>
                                <small class="text-muted"> (<?= htmlspecialchars($gita['data']) ?>)</small>
                            </h5>

                            <!-- Tour associati -->
                            <p class="mb-1">
                                <strong>Tour selezionati:</strong><br>
                                <?= htmlspecialchars($gita['tour_list']) ?: 'Nessuno' ?>
                            </p>

                            <!-- Costo totale -->
                            <p class="mb-0">
                                <strong>Costo totale:</strong> €<?= number_format($gita['costo_totale'], 2) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Messaggio se nessuna gita è presente -->
        <div class="alert alert-info" role="alert">
            Non sei ancora iscritto a nessuna gita.
        </div>
    <?php endif; ?>
</div>

<?php include 'views/partials/footer.php'; ?>
