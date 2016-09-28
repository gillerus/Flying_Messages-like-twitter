<?php
session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Twitter_zaloguj</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <center><br>
                <img src="http://st.depositphotos.com/1742172/3621/v/170/depositphotos_36210739-Cartoon-rocket.jpg" width="200">
                <br><br>
                <h4>Witamy na stronie "Flying Messages" dołącz do naszej kosmicznej społeczności<br>
                    aby w ekspersowym tempie wymieniać się wiadomościami!<br/>

                    <br/>--> zaloguj się </h4>
                <form action="zaloguj.php" method="post">
                    Email: <input type="text" name="email">
                    <!-- password pole txt żebym widział co testowo wpisuje, później do poprawy !!!!  -->
                    Password: <input type="text" name="password"><br><br>
                    <input type="submit" value="Zaloguj się">
                </form>
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                }
                ?>
                <br/><br/><hr/>
                <h4>--> lub zarejestruj</h4>
               

            </center>
        </div>
    </body>
</html>