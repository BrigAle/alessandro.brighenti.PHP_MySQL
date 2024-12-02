<?php
session_start();
require 'risorse/PHP/connection.php';
$connection = new mysqli($host, $user, $password, $db);
if ($connection->connect_error) {
    die("Connessione fallita: " . $connection->connect_error);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Castel Porziano </title>
    <meta name="author" content="Brighenti" />
    <link rel="shortcut icon" href="risorse\immagini\stendardo.ico" type="image/x-ico" />
    <link rel="stylesheet" href="risorse\CSS\style.css" type="text/css" />
</head>

<body style="overflow: hidden;">
    <!-- div menu -->
    <div class="menu">
        <a href="Homepage.php">HomePage</a>
        <a href="Info.php">Informazioni</a>
        <a href="Contatti.php">Contatti</a>
        <a href="Galleria.php">Galleria</a>
        <a href="Login.php">Login</a>
        <a href="Logout.php">Logout</a>
    </div>
    <!-- div titolo principale -->
    <!-- <div class="titolo">
            <h1>Benvenuti a Castel Porziano</h1>
        </div> -->
    <!-- div contenuto -->
    <div class="wrapper">
        <div class="container">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="stickydiv">
                    <!-- <h2>Menu</h2> -->
                    <ul>
                        <li><a href="Homepage.php">HomePage</a></li>
                        <li><a href="Info.php">Informazioni</a></li>
                        <li><a href="Contatti.php">Contatti</a></li>
                        <li><a href="Galleria.php">Galleria</a></li>
                        <?php
                        if (!isset($_SESSION['username'])) {
                            echo "<li><a href=\"loginPage.php\">Login</a></li>";
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['username']) && $_SESSION['logged'] == true) {
                            echo "<li><a href=\"prenotazione.php\">Prenota Visita</a></li>";
                            echo "<li><a href=\"prenotazioniEffettuate.php\">Visualizza Prenotazioni</a></li>";
                            if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 2) {
                                echo "<li><a href=\"aggiungiVisita.php\">Aggiungi visita</a></li>";
                            }
                            echo "<li><a href=\"risorse/PHP/logout.php\">Logout</a></li>";
                        } else {
                            echo "<li><a href=\"registerPage.php\">Registrati</a></li>";
                        }
                        ?>

                    </ul>
                </div>
            </div>

            <!-- Contenuto principale -->
            <div class="contenuto" style="font-family:Arial, Helvetica, sans-serif; background-color:lightgreen">
            <?php if (isset($_SESSION['username']) && isset($_SESSION['logged']) && $_SESSION['logged'] == true):
                
                $id = $_SESSION['id'];
                // query per selezionare le prenotazioni effettuate dall'utente loggato
                // eseguo un join tra la tabella prenotazione e la tabella visita per ottenere i dati relativi alla prenotazione
                $queryP = " SELECT p.id AS id_prenotazione, v.nome, v.data, v.ora 
                                FROM prenotazione p
                                JOIN visita v ON p.id_visita = v.id
                                WHERE p.id_utente = $id;";
                //eseguo la query nel database e salvo il risultato in una variabile $result
                $result = $connection->query($queryP);
                //se il risultato non e' negativo e il numero di record trovati dalla query e' maggiore di 0 allora stampo i dati
                if ($result && $result->num_rows > 0):
                    if (isset($_SESSION['delete'])) {
                        echo "<h2>" . $_SESSION['delete'] . "</h2>";
                        unset($_SESSION['delete']);
                    }
                    //ciclo per stampare i dati
                echo "<div class=\"box_prenotazione\">";
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)):
                ?>
                        <div class="contenuto_prenotazione">
                            <p>Nome visita: <?= htmlspecialchars($row['nome']); ?></p>
                            <p>Data: <?= htmlspecialchars($row['data']); ?></p>
                            <p>Ora: <?= htmlspecialchars($row['ora']); ?></p>
                        
                        <!--    Creo un form con un campo hidden che invia l'ID della prenotazione al file eliminaPrenotazione.php 
                                quando l'utente clicca su "Elimina".  -->
                        <form action="risorse/PHP/eliminaPrenotazione.php" method="POST">
                            <input type="hidden" name="id_prenotazione" value="<?= htmlspecialchars($row['id_prenotazione']); ?>">
                            <input type="submit" value="Elimina prenotazione">
                        </form>
                        </div>
                <?php
                    endwhile;
                echo "</div>";
                else:
                    echo "<h3>Non ci sono prenotazioni.</h3>";
                endif;
                     ?>
            <?php else:
                echo "<h3> Devi effettuare il login per visualizzare le prenotazioni. </h3>";
            endif;
            ?>
            </div>
        </div>
    </div>
    <!-- div piè di pagina -->
    <!-- <div class="pdp">
        <p>&amp; 2024 Castelporziano.</p>
    </div> -->
</body>

</html>