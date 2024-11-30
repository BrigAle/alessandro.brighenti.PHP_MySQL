<?php
session_start();
// Connessione al database
$conn = new mysqli('localhost', 'root', '', 'database_homework2');

// Verifica connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}


// Gestione dell'invio del modulo

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 2) {
    $data_visita = $_POST['data_visita'];
    $tipologia_visita = $_POST['tipologia_visita'];
    $ora_visita = $_POST['ora_visita'];
    $id_utente = $_SESSION['id'];
    $sql = "INSERT INTO visita (data, ora, nome,id_utente) VALUES ('$data_visita','$ora_visita', '$tipologia_visita','$id_utente')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['visitaAggiunta'] = 'true';
        header('Location: ../../aggiungiVisita.php');
    } else {
        $_SESSION['visitaAggiunta'] = 'false';
        header('Location: ../../aggiungiVisita.php');
    }
}
?>