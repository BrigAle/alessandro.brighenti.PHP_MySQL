<?php
session_start();
// Connessione al database
$connection = new mysqli('localhost', 'root', '', 'database_homework2');

// Verifica connessione
if ($connection->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}



// Salva la prenotazione
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_utente = $_SESSION['id'];
    $id_visita = $connection->real_escape_string($_POST['visita']);
    $sql = "INSERT INTO prenotazione (id_utente, id_visita) VALUES ('$id_utente', '$id_visita')";
    if ($connection->query($sql) === TRUE) {
        echo "Prenotazione effettuata con successo!";
    } else {
        echo "Errore: " . $sql . "<br>" . $conn->error;
    }
}
