<?php
session_start();
$connection = new mysqli('localhost', 'root', '', 'database_homework2');

// Verifica connessione
if ($connection->connect_error) {
    die("Connessione fallita: " . $connection->connect_error);
}

// Recupera le visite disponibili
$queryV = "SELECT id AS id_visita, nome, ora, data FROM visita ORDER BY data,ora";
$result = $connection->query($queryV);
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

<body>
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
                <?php
                if (isset($_SESSION['username']) && isset($_SESSION['logged']) && $_SESSION['logged'] == true):
                    if ($result->num_rows > 0):
                ?>
                    <!-- Creo un form a blocchi in stile wrap ovvero: gli elementi figli vanno a capo e si dispongono su righe successive quando non c'è abbastanza spazio.  
                            e invio l'id della visita al file prenotazione_utente.php-->
                        <form action="risorse/PHP/prenotazione_utente.php" method="POST" class="">
                            <h2 style="text-align: center;  background-color:aliceblue; border-radius:5px">Prenota una visita</h2>
                            <div class="boxVisita">
                                <!-- ciclo while in cui vengono estratti i record dalla query $queryV -->
                                <?php while ($row = $result->fetch_array(MYSQLI_ASSOC)): ?>
                                    <label class="labelVisita">
                                        <h3 style="color: black; font-size: large;">
                                            <?php echo $row['nome']; ?>
                                        </h3>
                                        <div class="contenutoLabel">
                                            <p>Data: <?php echo $row['data']; ?></p>
                                            <p>Ora: <?php echo $row['ora']; ?></p>
                                            <input type="radio" name="id_visita" value="<?php echo $row['id_visita']; ?>" required>
                                        </div>
                                    </label>
                                <?php endwhile; ?>
                            </div>
                            
                            <?php
                            // in questo caso ho scelto assegnare alle variabili di sessione, un messaggio di errore o di successo e, poi stamparlo in questa pagina
                            if (isset($_SESSION['successP'])): ?>
                                <p style="text-align:center; color: darkgreen;">
                                    <?php echo $_SESSION['successP']; ?>
                                </p>
                                <?php unset($_SESSION['successP']); ?>

                            <?php elseif (isset($_SESSION['errorP'])): ?>
                                <p style="text-align:center; color: red;">
                                    <?php echo $_SESSION['errorP']; ?>
                                </p>
                                <?php unset($_SESSION['errorP']); ?>
                            <?php endif; ?>
                            <button type="submit" class="submit-button">Prenota</button>

                        </form>
                    <?php
                    else: echo "<p>Nessuna visita disponibile</p>";
                    ?>
                    <?php endif; ?>
                <?php else: echo "<p>Devi essere loggato per prenotare una visita</p>" ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <!-- div piè di pagina -->
    <div class="pdp">
        <p>&amp; 2024 Castelporziano.</p>
    </div>
</body>

</html>