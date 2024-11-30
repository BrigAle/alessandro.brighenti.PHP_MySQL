<?php 
session_start();
require 'risorse/PHP/connection.php';
$connection = new mysqli($host, $user, $password, $db);

// voglio estrarre tutte le prenotazioni effettuate dall'utente

if(isset($_SESSION['username']) && isset($_SESSION['logged']) && $_SESSION['logged'] == true){
    echo $id;
    // query che seleziona dati della visita associata alla prenotazione effettuata dall'utente loggato

    $query = "SELECT v.nome, v.data, v.ora FROM prenotazione p JOIN visita v ON p.id_visita = v.id JOIN utente u ON p.id_utente = u.id WHERE u.id= $id;";
    $result = $connection->query($query);
    if($result){
        if($result->num_rows > 0){
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo "<table>";
            echo "<tr>";
            echo "<th>Nome: ".$row['nome'] ."</th>";
            echo "<th>Data: ".$row['data']."</th>";
            echo "<th>Ora: ".$row['ora']."</th>";
            echo "</tr>";
            }
        }
        }
    }
    else{
        echo "<p>Devi essere loggato per visualizzare le prenotazioni effettuate</p>";
    }





