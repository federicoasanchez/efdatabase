<?php
// Dati di accesso al database
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'efdatabase';

// Crea la connessione al database
$conn = new mysqli($host, $user, $pass, $dbname);

// Controlla se la connessione ha avuto successo
if ($conn->connect_error) {
    // In caso di errore di connessione, stampa messaggio e termina
    echo "Errore: connessione al database fallita.";
    exit;
}

// Preleva i dati inviati dal form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$ruolo = $_POST['ruolo'] ?? '';

// Controlla se i campi sono stati compilati
if ($username === '' || $password === '' || $ruolo === '') {
    echo "Errore: tutti i campi sono obbligatori.";
    exit;
}

// Crea un hash sicuro della password per proteggerla
$hash = password_hash($password, PASSWORD_DEFAULT);

// Prepara la query SQL con parametri per evitare SQL injection
$sql = "INSERT INTO utenti (username, password, ruolo) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

// Collega i parametri alla query (tutti stringhe: "sss")
$stmt->bind_param("sss", $username, $hash, $ruolo);

// Esegue la query
if ($stmt->execute()) {
    // Se l'inserimento è andato a buon fine, invia messaggio positivo
    echo "Registrazione completata con successo, $username!";
} else {
    // Se si è verificato un errore (es. username già esistente), mostra errore
    echo "Errore durante la registrazione: " . $stmt->error;
}

// Chiude la query e la connessione
$stmt->close();
$conn->close();
?>
