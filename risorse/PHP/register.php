<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    require('connection.php');


    $connection = new mysqli($host, $user, $password, $db);
    $username = $connection->real_escape_string($_POST['username']);
    $email = $connection->real_escape_string($_POST['email']);
    $password = $connection->real_escape_string($_POST['password']);
    $password2 = $connection->real_escape_string($_POST['password2']);

    $hashPassword = password_hash($password,PASSWORD_DEFAULT);

    $check_user = "SELECT * FROM utente WHERE username ='$username';";
    $result_user = mysqli_query($connection, $check_user);

    // myqli_num_rows ritorna il numero di righe nel result
    // se il numero di righe è maggiore di 0, l'utente esiste già

    if(mysqli_num_rows($result_user) > 0){
        $_SESSION['error_user'] = 'true'; // Setta la variabile di sessione errore_user a true
        header('location:../../registerPage.php?errore=user'); // Reindirizza alla pagina di registrazione con errore
        exit(1); // Esce con codice di errore
    }

    $check_email = "SELECT * FROM utente WHERE email ='$email';";
    $result_email = mysqli_query($connection, $check_email);

    if(mysqli_num_rows($result_email) > 0){
        $_SESSION['error_email'] = 'true';
        header('location:../../registerPage.php?error=email');
        exit(1);
    }

    if($password !== $password2){
        $_SESSION['error_password'] = 'true';
        header('location:../../registerPage.php?error=password');
        exit(1);
    }

    $sql = "INSERT INTO utente (username, email, password) VALUES ('$username','$email','$hashPassword');";
    $insert = mysqli_query($connection, $sql);

    header('location:../../loginPage.php');

}else{
    header('location: ../../registerPage.php');
    exit(1);
}
