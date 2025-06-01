<?php
// Connessione al database
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'efdatabase'; // assicurati che questo database esista

$conn = new mysqli($host, $user, $pass, $dbname);

// Verifica connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Preleva dati dal form
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Sicurezza!

// Inserimento nel database
$sql = "INSERT INTO utenti (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    echo "Registrazione completata con successo.";
} else {
    echo "Errore: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
