<?php include 'views/partials/header.php'; ?>

<div class="container mt-5 mb-5">
    <!-- Titolo della sezione -->
    <h2 class="text-primary mb-4 text-center">Pannello di Amministrazione</h2>

    <!-- Sezioni gestibili -->
    <div class="row g-4 justify-content-center">
        <!-- Gestione Gite -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Gestione Gite</h5>
                    <p class="card-text">Visualizza, modifica o aggiungi nuove gite scolastiche.</p>
                    <a href="?controller=admin&action=trips" class="btn btn-outline-primary">Vai</a>
                </div>
            </div>
        </div>

        <!-- Gestione Tour -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Gestione Tour</h5>
                    <p class="card-text">Gestisci le attività opzionali associate alle gite.</p>
                    <a href="?controller=admin&action=tours" class="btn btn-outline-primary">Vai</a>
                </div>
            </div>
        </div>

        <!-- Gestione Utenti -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Gestione Utenti</h5>
                    <p class="card-text">Controlla e modifica i profili utente registrati.</p>
                    <a href="?controller=admin&action=users" class="btn btn-outline-primary">Vai</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'views/partials/footer.php'; ?>
