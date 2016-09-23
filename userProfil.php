<?php
session_start();

include 'src/database.php';
include 'src/Tweets.php';

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
        if ($_SESSION['loggedUseerId'] === $_GET['id']) {
            echo '<a href="userProfil.php?id=' . $row->getUserId() . '">DELETE</a><br>';
        }
        echo '<br>';
    }
}
?>

<br><a href="index.php">Powrot</a>