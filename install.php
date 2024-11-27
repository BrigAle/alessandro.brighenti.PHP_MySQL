<?php
// require once per includere il file connection.php
require_once('risorse/PHP/connection.php');

// dichiaro le variabili per la connessione al server
$connection = new mysqli($host, $user, $password);

// controllo se la connessione è andata a buon fine
if ($connection->connect_error) {
    exit("Connessione al server fallita: " . $connection->connect_error);
}



// creo il database
$sql_db = "CREATE DATABASE IF NOT EXISTS $db";
if ($connection->query($sql_db) === FALSE) {
    echo "Errore nella creazione del database " . $connection->error;
}

// dichiaro la variabile per la connessione al database
$connection = new mysqli($host, $user, $password, $db);

// controllo se la connessione al database è andata a buon fine
if ($connection->connect_error) {
    exit("Connessione al database fallita: " . $connection->connect_error);
}


// creo tabella utente
// id ruolo 1 = utente normale 2 = admin
$sql_table_utente = "CREATE TABLE IF NOT EXISTS utente(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        id_ruolo INT(6) UNSIGNED NOT NULL DEFAULT 1, 
        password VARCHAR(255) NOT NULL,
        UNIQUE (username, email)
    );";
if ($connection->query($sql_table_utente) === FALSE) {
    echo "Errore nella creazione della tabella " . $connection->error;
}

// creo tabella visita, aggiungo una chiave surrogata id utente per poter aggiungere tipologie di visite
$sql_table_visita = "CREATE TABLE IF NOT EXISTS visita(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(30) NOT NULL,
        data DATE NOT NULL,
        ora TIME NOT NULL,
        id_utente INT(6) UNSIGNED,
        FOREIGN KEY (id_utente) references utente(id)
    );";
if ($connection->query($sql_table_visita) === FALSE) {
    echo "Errore nella creazione della tabella " . $connection->error;
}

// creo tabella prenotazione con chiave surrogata id utente e id visita
$sql_table_prenotazione = "CREATE TABLE IF NOT EXISTS prenotazione(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        id_utente INT(6) UNSIGNED,
        id_visita INT(6) UNSIGNED,
        data DATE NOT NULL,
        FOREIGN KEY (id_utente) REFERENCES utente(id),
        FOREIGN KEY (id_visita) REFERENCES visita(id)
    );";

if ($connection->query($sql_table_prenotazione) === FALSE) {
    echo "Errore nella creazione della tabella " . $connection->error;
}


// inserisco utente admin con hashing della password
$check_admin = "SELECT * FROM utente WHERE username = 'admin';";
$result_admin = mysqli_query($connection, $check_admin);
if (!mysqli_num_rows($result_admin) > 0) {

    $pwd_admin = password_hash('admin', PASSWORD_DEFAULT);
    $sql_admin = "INSERT INTO utente (username, email, password, id_ruolo) VALUES ('admin',' admin@gmail.it','" . $pwd_admin . "', 2);";

    if ($connection->query($sql_admin) === FALSE) {
        echo "Errore nell'inserimento dell'utente admin " . $connection->error;
    }
}


// inserisco utente brigale con hashing della password

$check_brigale = "SELECT * FROM utente WHERE username = 'brigale';";
$result_utente = mysqli_query($connection, $check_brigale);
if (!mysqli_num_rows($result_utente) > 0) {
    $pwd_brigale = password_hash('ale', PASSWORD_DEFAULT);
    $sql_brigale = "INSERT INTO utente (username, email, password) VALUES ('brigale','brigale@gmail.com','" . $pwd_brigale . "');";
    if ($connection->query($sql_brigale) === FALSE) {
        echo "Errore nell'inserimento dell'utente admin " . $connection->error;
    }
}
$connection->close();
header('location: Homepage.php');
exit(1);
