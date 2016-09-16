<?php

session_start();

include 'src/database.php';
include 'src/Users.php';
include 'src/Tweets.php';

echo "Witaj <b>" . $_SESSION['username'] . "</b>! Oto Twoje aktualne Tweety ;)<br/><br/>";

$conn = DataBase::conn();

//$nu = new Users();
//
//$nu->setUsername('Jola');
//$nu->setEmail('jola@wp.pl');
//$nu->setPassword('jola');
//
//$nu->saveToDB($conn);

$allTweets = Tweets::loadAllTweets($conn);

foreach ($allTweets as $row) {
    $displayContnet = $row->getContent();
    $craetionDate = $row->getCreationDate();

    echo $displayContnet;
    echo '<br/>';
    echo "Dodany przez uzytkownika: " . "$row->username" . " " . "$craetionDate";
    echo '<br/><br/>';
}

DataBase::closeConn($conn);
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Twitter</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
   
        <div class="container">
            <h4>Skrobnij nowego tweeta:</h4>
            <form>
                <input type="text" size="40" name="newTweet">
                <input type="submit" value="ADD">
            </form>

        </div>
   
    </body>
</html>



