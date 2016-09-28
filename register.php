<?php
session_start();

require 'src/database.php';

if (isset($_POST['email_reg'])) {
    $allOK = true;
    //poprawnosc nick
    $nick = $_POST['username_reg'];
    if (strlen($nick) > 30) {
        $allOK = false;
        $_SESSION['e_nick'] = 'Username nie moze byc dluzszy niz 30 znakow';
    }
    //poprawnosc email
    $email = $_POST['email_reg'];
    $email_b = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($email_b, FILTER_VALIDATE_EMAIL) == false) || ($email != $email_b)) {
        $allOK = false;
        $_SESSION['e_email'] = 'Podaj poprawny adres email';
    }
    //poprawnosc hasla
    $haslo1 = $_POST['password_reg'];
    $haslo2 = $_POST['confirm_password_reg'];

    if (strlen($haslo1) < 8) {
        $allOK = false;
        $_SESSION['e_pass'] = 'Haslo musi posiadac co najmniej 8 znakow';
    }
    if ($haslo1 !== $haslo2) {
        $allOK = false;
        $_SESSION['e_pass'] = 'Podane hasla nie sa identyczne';
    }
    
    
    
    
    //sprawdzenie captcha
    $secret = "6Lf13QcUAAAAAF2BRYWRBjKue-v4vghS18nT9hg0";
    $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
    $answer = json_decode($check);

    if ($answer->success == false){
        $allOK = false;
        $_SESSION['e_bot'] = 'Wypelnij captcha';
    }


    //WSZYSTKO OK
        if ($allOK == true) {
            //dodajemy gracza do bazy
            echo 'Udana walidacja!';
            exit();
        }
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Twitter_zarejestruj</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <style>
            .error{
                color: red;
                margin-top: 10px;
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">

            <form method="post">
                Username: <input type="text" name="username_reg"><br>
                <?php
                if (isset($_SESSION['e_nick'])) {
                    echo '<div class="error">' . $_SESSION['e_nick'] . '</div>';
                    unset($_SESSION['e_nick']);
                }
                ?>
                Email: <input type="text" name="email_reg"><br>
                <?php
                if (isset($_SESSION['e_email'])) {
                    echo '<div class="error">' . $_SESSION['e_email'] . '</div>';
                    unset($_SESSION['e_email']);
                }
                ?>
                Password: <input type="password" name="password_reg"><br>
                <?php
                if (isset($_SESSION['e_pass'])) {
                    echo '<div class="error">' . $_SESSION['e_pass'] . '</div>';
                    unset($_SESSION['e_pass']);
                }
                ?>
                Confirm Password: <input type="password" name="confirm_password_reg"><br>
                <?php
                if (isset($_SESSION['e_pass'])) {
                    echo '<div class="error">' . $_SESSION['e_pass'] . '</div>';
                    unset($_SESSION['e_pass']);
                }
                ?>
                <div class="g-recaptcha" data-sitekey="6Lf13QcUAAAAAL2lfuVuOZJ8VFWJu-ueNcY2Fvum"></div><br>
                <?php
                if (isset($_SESSION['e_bot'])) {
                    echo '<div class="error">' . $_SESSION['e_bot'] . '</div>';
                    unset($_SESSION['e_bot']);
                }
                ?>
                <input type="submit" value="Zarejestruj się">
            </form>


        </div>
    </body>
</html>