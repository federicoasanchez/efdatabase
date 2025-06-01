<?php
// Imposta il tipo di risposta come JSON
header('Content-Type: application/json');

// Connessione al database
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'efdatabase';
$conn = new mysqli($host, $user, $pass, $dbname);

// Se la connessione fallisce, invia errore
if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "message" => "Errore di connessione al database.",
        "error_detail" => $conn->connect_error
    ]);
    exit;
}

// Recupera e valida i dati
$nome = $_POST['nome'] ?? '';
$cognome = $_POST['cognome'] ?? '';
$username = $_POST['username'] ?? '';
$ruolo = $_POST['ruolo'] ?? '';
$password = $_POST['password'] ?? '';

if (!$nome || !$cognome || !$username || !$ruolo || !$password) {
    echo json_encode([
        "success" => false,
        "message" => "Dati mancanti. Compila tutti i campi richiesti.",
        "error_detail" => "Uno o più campi POST sono vuoti."
    ]);
    exit;
}

// Cripta la password in modo sicuro
$hash = password_hash($password, PASSWORD_DEFAULT);

// Prepara e esegue la query
$sql = "INSERT INTO utenti (nome, cognome, username, password, ruolo) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => "Errore interno nella preparazione della query.",
        "error_detail" => $conn->error
    ]);
    exit;
}

$stmt->bind_param("sssss", $nome, $cognome, $username, $hash, $ruolo);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Registrazione completata con successo, $nome $cognome!"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Registrazione fallita per errore del database.",
        "error_detail" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>
