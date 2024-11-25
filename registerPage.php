<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:>

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
            <!-- form di registrazione -->
            <div class="contenuto">
                <form action="risorse/PHP/register.php" method="POST" class="login-form">
                    <label for="username" class="form-label"></label>
                    <input type="text" name="username" id="username" class="form-input" placeholder="Username" required>

                    <label for="password" class="form-label"></label>
                    <input type="password" name="password" id="password" class="form-input" placeholder="Password" required>

                    <label for="password2" class="form-label"></label>
                    <input type="password" name="password2" id="password2" class="form-input" placeholder="Conferma Password" required>

                    <label for="email" class="form-label"></label>
                    <input type="email" name="email" id="email" class="form-input" placeholder="email" required>
                    <input type="submit" value="Registrati" class="form-submit">
                </form>
                <p>Già registrato? Entra <a href="loginPage.php">qui</a></p>
            </div>

        </div>
    </div>
</body>