<?php 
session_start();
require 'connection.php';
$connection = new mysqli($host, $user, $password, $db);

if ($connection->connect_error) {
    die("Connessione al database fallita: " . $connection->connect_error);
}
if (isset($_POST['id_prenotazione'])) {
    $id_prenotazione = $_POST['id_prenotazione'];
    $delete = "DELETE FROM prenotazione WHERE id = $id_prenotazione;";

    if ($connection->query($delete) === TRUE) {
        $_SESSION['delete'] = "Prenotazione eliminata con successo.";
    } else {
        $_SESSION['delete'] = "Errore durante l'eliminazione della prenotazione.";
    }

header("Location: ../../prenotazioniEffettuate.php");
exit();
}else{
    $_SESSION['delete'] = "Errore durante l'eliminazione della prenotazione.";
    header("Location: ../../prenotazioniEffettuate.php");
    exit();
}
?>