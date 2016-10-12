<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include 'src/database.php';
include 'src/Tweets.php';

echo "Profil uzytkownika: <b>" . $_SESSION['username'] . '</b>! Oto Twoje Tweety ;) | <a href="logout.php">Wyloguj</a><br/>';
echo '<a href="messages.php">Skrzynka pocztowa</a><br/><br/>';
echo '<br>';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $conn = DataBase::conn();
    $userTweet = Tweets::loadTweetsByUserId($conn, $_GET['id']);
    DataBase::closeConn($conn);


    foreach ($userTweet as $row) {
        $displayContnet = $row->getContent();
        $craetionDate = $row->getCreationDate();

        echo $displayContnet;
        echo '<br/>';
        echo 'Dodany przez uzytkownika: <a href="userProfil.php?id=' . $row->getUserId() . '">' . $row->username . '</a>' . " " . $craetionDate;
        echo '<br>';
        echo '<a href="tweet.php?id=' . $row->getId() . '">Skomentuj</a>';
        echo ' | ';
        if ($_SESSION['loggedUseerId'] === $_GET['id']) {
            echo "<a href='deleteTweet.php?user=" . $_GET['id'] . "&&id=" . $row->getId() . "'>DELETE</a><br>";
        }
        echo '<br>';
    }
}
?>

<br><a href="index.php">Powrot</a>