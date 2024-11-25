<?php
    // require once per includere il file connection.php
    require_once('connection.php');

    // dichiaro le variabili per la connessione al server
    $connection = new mysqli($host, $user, $password);

    // controllo se la connessione è andata a buon fine
    if($connection->connect_error){
        exit("Connessione al server fallita: " . $connection->connect_error);
    }

    // creo il database
    $sql_db = "CREATE DATABASE IF NOT EXISTS $db";
    if($connection->query($sql) === FALSE){
        echo "Errore nella creazione del database " . $connection->error;
    }

    // dichiaro la variabile per la connessione al database
    $connection = new mysqli($host, $user, $password, $db);

    // controllo se la connessione al database è andata a buon fine
    if($connection->connect_error){
        exit("Connessione al database fallita: " . $connection->connect_error);
    }


    // creo tabella utente
    // id ruolo 1 = utente normale 2 = admin
    $sql_table_utente = "CREATE TABLE IF NOT EXISTS utente(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        id_ruolo INT(6) UNSIGNED NOT NULL DEFAULT 1, 
        password VARCHAR(255) NOT NULL
    );";
    if($connection->query($sql_table) === FALSE){
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
    if($connection->query($sql_table) === FALSE){
        echo "Errore nella creazione della tabella " . $connection->error;
    }


    // creo tabella visita, aggiungo una chiave surrogata id utente per poter aggiungere tipologie di visite
    $sql_table_visita = "CREATE TABLE IF NOT EXISTS visita(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(30) NOT NULL,
        data DATE NOT NULL,
        ora TIME NOT NULL,
        FOREIGN KEY (id_utente) references utente(id)
    );";
    if($connection->query($sql_table_visita) === FALSE){
        echo "Errore nella creazione della tabella " . $connection->error;
    }


    // inserisco utente admin
    $sql_admin = "INSERT INTO utente (username, email, password, id_ruolo) VALUES ('admin',' admin@gmail.it','admin', 2);";
    if($connection->query($sql_admin) === FALSE){
        echo "Errore nell'inserimento dell'utente admin " . $connection->error;
    }

    // inserisco utente brigale
    $sql_utente = "INSERT INTO utente (username, email, password) VALUES ('brigale','brigale@gmail.com','ale');";
    if($connection->query($sql_admin) === FALSE){
        echo "Errore nell'inserimento dell'utente admin " . $connection->error;
    }
    $connection->close();

    header('location:../../register.php');
    exit(1);
?>
