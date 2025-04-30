<?php include 'views/partials/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Titolo della pagina -->
            <h2 class="mb-4 text-primary text-center">Scrivi una Recensione</h2>

            <!-- Form per inviare la recensione -->
            <form method="POST" action="?controller=trip&action=review&id=<?= $trip_id ?>" class="border rounded p-4 shadow-sm bg-light">

                <!-- Campo per selezionare il voto -->
                <div class="mb-3">
                    <label for="voto" class="form-label">Voto (1-5)</label>
                    <select name="voto" id="voto" class="form-select" required>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <!-- Ogni opzione rappresenta una stella -->
                            <option value="<?= $i ?>"><?= $i ?> ★</option>
                        <?php endfor; ?>
                    </select>
                </div>

                <!-- Campo per scrivere il commento -->
                <div class="mb-3">
                    <label for="commento" class="form-label">Commento</label>
                    <textarea 
                        name="commento" 
                        id="commento" 
                        class="form-control" 
                        rows="4" 
                        placeholder="Scrivi qui la tua esperienza..." 
                        required
                    ></textarea>
                </div>

                <!-- Bottone per inviare la recensione -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Invia Recensione</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include 'views/partials/footer.php'; ?>
