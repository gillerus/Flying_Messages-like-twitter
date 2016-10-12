<?php

session_start();

require 'src/database.php';
require 'src/Tweets.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        var_dump($id);
        $conn = DataBase::conn();
        Tweets::deleteTweet($conn, $id);
        DataBase::closeConn($conn);
        if (isset($_GET['user'])) {
            header('Location: userProfil.php?id=' . $_GET['user'] . '');
        } else {
            header('Location: index.php');
        }
    } else {
        echo 'bledne dane';
    }
} else {
    echo 'blad';
}
