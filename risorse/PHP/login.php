<?php 
    session_start();
    require('connection.php');

    $connection = new mysqli($host, $user, $password, $db);
    $username = $connection->real_escape_string($_POST['username']);
    $password = $connection->real_escape_string($_POST['password']);
    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $check = "SELECT * FROM utente u WHERE u.username = '$username'";
        
        $result = $connection->query($check);
        if($result){
            if(mysqli_num_rows($result) == 1){
                $record = $result->fetch_array(MYSQLI_ASSOC);
                if(password_verify($password, $record['password'])){
                    $_SESSION['username'] = $username;
                    $_SESSION['logged'] = 'true';
                    $_SESSION['id'] = $record['id'];
                    if($record['id_ruolo'] == 2){
                        $_SESSION['ruolo'] = 2;
                        header('Location: ../../Homepage.php');
                        exit(1);
                    }
                    header('Location: ../../Homepage.php');
                    exit(1);          
                }else{
                    $_SESSION['error_password'] = 'true';
                    header('Location:../../loginPage.php');
                    exit(1);
                }
            }else{
                $_SESSION['error_username'] = 'true';
                header('Location:../../loginPage.php');
                exit(1);
            }
        }else{
            $_SESSION['error_users'] = 'true';
            header('Location:../../loginPage.php');
            exit(1);
        }
        $connection->close();
    }
?>
