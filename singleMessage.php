<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include 'src/database.php';
include 'src/Tweets.php';
include 'src/Comments.php';
include 'src/Messages.php';
?>


<!DOCTYPE html>

<html>
    <head>
        <title>Single message</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <?php
            echo "Skrzynka prywatnych wiadomosci uzytkownika: " . $_SESSION['username'];

            echo '<br><br>';
            
            ?>
            

          
            Wyslij przywatna wiadomosc:<br><br>
            <form action="checkUser.php" method="post">
                Do uzytkowniaka:<br>
                <input type="text" size="30" name="userName"><br>
                Tresc:<br>
                <textarea name="newMessage" placeholder="Nawijaj ..."></textarea>
                <br><br>
                <input type="submit" value="Send">
            </form>
            <?php
            if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
            ?>     

            <br><a href="messages.php">Powrot</a><br><br>
        </div>
    </body>
</html>

