<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include 'src/database.php';
include 'src/Users.php';
include 'src/Tweets.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newTweet = new Tweets();
    $newTweet->setUserId($_SESSION['loggedUseerId']);
    $newTweet->setContent($_POST['newTweet']);

    $conn = DataBase::conn();
    $newTweet->saveToDB($conn);
    DataBase::closeConn($conn);

    header('Location: index.php');
}


echo '<div class="container">';
echo "Witaj <b>" . $_SESSION['username'] . '</b>! Oto Twoje aktualne Tweety ;) | <a href="logout.php">Wyloguj</a><br/>';

echo 'Profil uzytkownika: <a href="userProfil.php?id=' . $_SESSION['loggedUseerId'] . '">' . $_SESSION['username'] . '</a> | ';
echo '<a href="messages.php">Skrzynka pocztowa</a><br/><br/>';
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
            <hr>
            <p>Skrobnij nowego tweeta:<p>
            <form action="#" method="post">
                <input type="text" size="30" name="newTweet">
                <br><br>
                <input type="submit" value="Add new Tweet">
            </form>
            <hr><br>
        </div>

    </body>
</html>

<?php
$conn = DataBase::conn();
$allTweets = Tweets::loadAllTweets($conn);
DataBase::closeConn($conn);

foreach ($allTweets as $row) {
    $displayContnet = $row->getContent();
    $craetionDate = $row->getCreationDate();

    echo $displayContnet;
    echo '<br/>';
    echo '<a href="tweet.php?id=' . $row->getId() . '">Skomentuj</a><br>';
    echo 'Dodany przez uzytkownika: <a href="userProfil.php?id=' . $row->getUserId() . '">' . $row->username . '</a>' . " " . $craetionDate;
    echo '<br/><br/>';
}
echo '</div>';





