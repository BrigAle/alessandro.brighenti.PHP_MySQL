<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Castel Porziano </title>
    <meta name="author" content="Brighenti" />
    <link rel="shortcut icon" href="risorse/immagini/stendardo.ico" type="image/x-ico" />
    <link rel="stylesheet" href="risorse/CSS/style.css" type="text/css" />
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
        <h1>Benvenuti a Castelporziano</h1>
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
                        <li><a href="loginPage.php">Login</a></li>
                        <li><a href="loginPage.php">Logout</a></li>
                    </ul>
                </div>
            </div>

            <div class="contenuto">
                <form action="risorse/PHP/login.php" method="POST" class="login-form">
                    <label for="username" class="form-label"></label>
                    <input type="text" name="username" id="username" placeholder="Username" class="form-input" required>

                    <label for="password" class="form-label"></label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-input" required>

                    <input type="submit" value="Login" class="form-submit">
                </form>
                <p>Non sei registrato? registrati <a href="registerPage.php">qui</a></p>
            </div>

        </div>
    </div>
</body>