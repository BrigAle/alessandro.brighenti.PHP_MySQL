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
    // Recupero l'id dell'utente dalla variabile di sessione 
    $id_utente = $_SESSION['id'];
    // Recupero l'id della visita dalla richiesta post 
    $id_visita = $connection->real_escape_string($_POST['id_visita']);
    $queryP = "INSERT INTO prenotazione (id_utente, id_visita) VALUES ('$id_utente', '$id_visita')";
    if ($connection->query($queryP) === TRUE) {
        $_SESSION['successP'] = "Prenotazione effettuata con successo";
        header('Location: ../../prenotazione.php');
        
    } else {
        $_SESSION['errorP'] = "Errore nella prenotazione";
        header('Location: ../../prenotazione.php');
    }
}
