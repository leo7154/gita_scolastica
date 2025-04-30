<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gite Scolastiche</title>

    <!-- Stile personalizzato -->
    <link rel="stylesheet" href="/gite-scolastiche-mysql/public/css/style.css">

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<!-- Navbar principale -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <!-- Logo / nome sito -->
        <a class="navbar-brand" href="/gite-scolastiche-mysql/">Gite Scolastiche</a>

        <!-- Bottone per hamburger menu su dispositivi mobili -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenuto del menu -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto">

                <!-- Link per amministratori -->
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=admin&action=trips">Admin Panel</a>
                    </li>
                <?php endif; ?>

                <!-- Link per utenti loggati -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=user&action=profile">Profilo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?controller=user&action=logout">Logout</a>
                    </li>
                <?php else: ?>
                    <!-- Link per utenti non loggati -->
                    <li class="nav-item">
                        <a class="nav-link" href="?controller=user&action=login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?controller=user&action=register">Registrati</a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

<!-- Inizio contenuto pagina -->
<div class="container mt-4">
