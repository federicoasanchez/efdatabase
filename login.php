<?php
// Questo è un esempio semplice, dovrai sostituire questa parte con la tua logica di autenticazione
$username = $_POST['username'];
$password = $_POST['password'];

// Esempio di credenziali hardcoded (solo per test, non per produzione)
if ($username == 'admin' && $password == 'password') {
    echo "Login riuscito!";
} else {
    echo "Credenziali non valide.";
}
?>
