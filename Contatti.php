<?php
    session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title> Castel Porziano </title>
    <meta name="author" content="Brighenti"/>
    <link rel="shortcut icon" href="risorse\immagini\stendardo.ico" type="image/x-ico"/>
    <link rel="stylesheet" href="risorse\CSS\style.css" type="text/css"/>
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
    <div class="titolo">
            <h1>Benvenuti a Castel Porziano</h1>
    </div>
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
                        <li><a href="Login.php">Login</a></li>
                        <li><a href="Logout.php">Logout</a></li>     
                    </ul>
                </div>
            </div>

            <!-- Contenuto principale -->
            <div class="contenuto">
                <img src="risorse/immagini/c_porziano_01.jpg" alt="" class="immagine" />
                <p class="testo">
                    Per maggiori informazioni visitare il sito ufficiale di <a href="https://palazzo.quirinale.it/palazzo.html">Castelporziano</a>, inoltre sul sito ufficiale si puo' anche fare una <a href="https://palazzo.quirinale.it/visitevirtuali/visitevirtuali.html"> visita virtuale</a>
                </p>
            </div>
        </div>
    </div>
    <!-- div piè di pagina -->
    <div class="pdp">
        <p>&amp; 2024 Castelporziano.</p>
    </div>
</body>

</html>