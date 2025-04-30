<?php include 'views/partials/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Titolo pagina -->
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">Accedi al tuo account</h2>
                <p class="text-muted">Inserisci le tue credenziali per continuare</p>
            </div>

            <!-- Form login -->
            <form method="POST" action="?controller=user&action=login" class="border rounded p-4 shadow-sm bg-light">
                
                <!-- Campo Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-control" 
                        placeholder="esempio@email.com"
                        required
                    >
                </div>

                <!-- Campo Password -->
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-control" 
                        placeholder="••••••••"
                        required
                    >
                </div>

                <!-- Bottone invio -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Accedi</button>
                </div>
            </form>

            <!-- Link alla registrazione -->
            <div class="text-center mt-3">
                <small>Non hai un account? <a href="?controller=user&action=register">Registrati ora</a></small>
            </div>

        </div>
    </div>
</div>

<?php include 'views/partials/footer.php'; ?>
