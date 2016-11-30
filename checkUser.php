<?php

echo 'checkUserSite';

session_start();

include 'src/database.php';
include 'src/Tweets.php';
include 'src/Comments.php';
include 'src/Messages.php';

$conn = DataBase::conn();

$userName = $_POST['userName'];

if (!empty($userName)) {

    $sql = 'SELECT * FROM Users WHERE username="' . $userName . '"';

    $result = $conn->query($sql);
    $user_amm = $result->num_rows;

    $row = $result->fetch_assoc();

    if ($row['username']) {

        $conn = database::Conn();

        $newMessage = new Messages();
        $newMessage->setSenderId($_SESSION['loggedUseerId']);
        $newMessage->setContent($_POST['newMessage']);
        $newMessage->setReciverId($newMessage->checkResiverId($conn, $_POST['userName']));
        $newMessage->saveToDB($conn);
        DataBase::closeConn($conn);

        unset($_SESSION['error']);
        $result->free_result();

        $_SESSION['error'] = '<div class="alert alert-info alert-dismissible" style="width: 600px"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Wiadomość wysłana</div>';
        header('location: singleMessage.php');
    } else {
        $_SESSION['error'] = '<div class="alert alert-danger alert-dismissible" style="width: 600px"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Podany nick nie istnieje w naszym serwisie.</div>';
        header('location: singleMessage.php');
    }
}
DataBase::closeConn($conn);

if (empty($userName)) {
    $_SESSION['error'] = '<div class="alert alert-danger alert-dismissible" style="width: 600px"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Podaj nick usera</div>';
    header('Location: singleMessage.php');
    exit();
}