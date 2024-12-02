<?php
session_start();
// Connessione al database
$connection = new mysqli('localhost', 'root', '', 'database_homework2');

// Verifica connessione
if ($connection->connect_error) {
    die("Connessione fallita: " . $connection->connect_error);
}


// Gestione dell'invio del modulo

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 2) {

    // Recupero i dati dal form
    $data_visita = $_POST['data_visita'];
    $tipologia_visita = $_POST['tipologia_visita'];
    $ora_visita = $_POST['ora_visita'];
    $id_utente = $_SESSION['id'];

    // Inserimento dei dati nel database
    $queryAV = "INSERT INTO visita (data, ora, nome,id_utente) VALUES ('$data_visita','$ora_visita', '$tipologia_visita','$id_utente')";
    
    // Controllo se l'inserimento è andato a buon fine e reindirizzo alla pagina di aggiunta visita
    if ($connection->query($queryAV) === TRUE) {
        $_SESSION['visitaAggiunta'] = 'true';
        header('Location: ../../aggiungiVisita.php');
    } else {
        $_SESSION['visitaAggiunta'] = 'false';
        header('Location: ../../aggiungiVisita.php');
    }
}
?>