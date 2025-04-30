<?php include 'views/partials/header.php'; ?>

<div class="container mt-5 mb-5">
    <!-- Titolo pagina -->
    <h2 class="text-primary mb-4">Gite Disponibili</h2>

    <!-- Layout a griglia -->
    <div class="row g-4">
        <?php foreach ($trips as $trip): ?>
            <div class="col-md-4">
                <!-- Card per ogni gita -->
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        
                        <!-- Nome meta -->
                        <h5 class="card-title text-dark"><?= htmlspecialchars($trip['nome_meta']) ?></h5>

                        <!-- Descrizione breve -->
                        <p class="card-text text-muted"><?= htmlspecialchars($trip['descrizione']) ?></p>

                        <!-- Info data e costo -->
                        <p class="mt-auto">
                            <strong>📅 Data:</strong> <?= htmlspecialchars($trip['data']) ?><br>
                            <strong>💰 Costo:</strong> €<?= number_format($trip['costo_base'], 2) ?>
                        </p>

                        <!-- Pulsante dettagli -->
                        <a href="?controller=trip&action=show&id=<?= $trip['id'] ?>" class="btn btn-primary btn-sm mt-2">
                            Dettagli
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'views/partials/footer.php'; ?>
