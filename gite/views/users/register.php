<?php include 'views/partials/header.php'; ?>

<!-- Contenitore centrato -->
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Titolo della pagina -->
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">Crea un Account</h2>
                <p class="text-muted">Compila il modulo per registrarti</p>
            </div>

            <!-- Modulo di registrazione -->
            <form method="POST" action="?controller=user&action=register" class="p-4 border rounded shadow-sm bg-light">
                
                <!-- Campo Nome -->
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control" required>
                </div>

                <!-- Campo Cognome -->
                <div class="mb-3">
                    <label for="cognome" class="form-label">Cognome</label>
                    <input type="text" id="cognome" name="cognome" class="form-control" required>
                </div>

                <!-- Campo Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <!-- Campo Password -->
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <!-- Bottone di invio -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Registrati</button>
                </div>
            </form>

            <!-- Link per il login -->
            <div class="text-center mt-3">
                <small>Hai già un account? <a href="?controller=user&action=login">Accedi qui</a></small>
            </div>

        </div>
    </div>
</div>

<?php include 'views/partials/footer.php'; ?>
