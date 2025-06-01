<?php
session_start();

// Verifica se l'utente è autenticato
if (!isset($_SESSION['utente'])) {
    header("Location: login.html");
    exit;
}

// Recupera i dati dell'utente
$nome = $_SESSION['utente']['nome'];
$cognome = $_SESSION['utente']['cognome'];
$ruolo = $_SESSION['utente']['ruolo'];
$username = $_SESSION['utente']['username'];
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - <?= htmlspecialchars($ruolo) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .privilegi-box {
            border-left: 5px solid #0d6efd;
            padding: 1rem;
            background: #f8f9fa;
            margin-top: 1rem;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h3 class="card-title">Benvenuto, <?= htmlspecialchars($nome) ?> <?= htmlspecialchars($cognome) ?>!</h3>
            <p class="card-text"><strong>Ruolo:</strong> <?= htmlspecialchars($ruolo) ?></p>
            <p class="card-text"><strong>Username:</strong> <code><?= htmlspecialchars($username) ?></code></p>

            <hr>

            <!-- Sezioni visibili solo a utenti con ruoli specifici -->
            <?php if ($ruolo === 'medico'): ?>
                <div class="privilegi-box">
                    <h5>Funzionalità per Medico</h5>
                    <ul>
                        <li>Visualizza elenco pazienti</li>
                        <li>Accedi alle procedure di elettrofisiologia</li>
                        <li>Compila e rivedi i referti</li>
                    </ul>
                </div>
            <?php elseif ($ruolo === 'infermiere'): ?>
                <div class="privilegi-box">
                    <h5>Funzionalità per Infermiere</h5>
                    <ul>
                        <li>Gestione dei parametri vitali</li>
                        <li>Assistenza pre e post procedura</li>
                        <li>Monitoraggio terapia</li>
                    </ul>
                </div>
            <?php elseif ($ruolo === 'tecnico-perfusionista'): ?>
                <div class="privilegi-box">
                    <h5>Funzionalità per Tecnico-Perfusionista</h5>
                    <ul>
                        <li>Controllo dei dispositivi</li>
                        <li>Registrazione delle procedure tecniche</li>
                        <li>Gestione del materiale sterile</li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">Ruolo non riconosciuto.</div>
            <?php endif; ?>

            <hr>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>
</body>
</html>
