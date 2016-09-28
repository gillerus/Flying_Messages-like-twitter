<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include 'src/database.php';
include 'src/Messages.php';

echo 'Pojedyncza wiadomosc uzytkownika: ' . $_SESSION['username'];
echo '<br><br>';

$conn = database::conn();

switch ($_GET['message']) {
    case 'r':
        
        $singleMessage = Messages::loadRecivedMessage($conn, $_GET['id']);
        $singleMessage->setReadm($conn, $_GET['id']);
        $content = $singleMessage->getContent();
        $creationDate = $singleMessage->getCreationDate();
        $username = $singleMessage->username;

        echo "Wiadomosc:<br>";
        echo "wyslana do: " . "$username" . " | data: " . "$creationDate";
        echo '<br>' . "$content";
        break;
    
    case 's':
        $singleMessage = Messages::loadSendMessage($conn, $_GET['id']);
        $content = $singleMessage->getContent();
        $creationDate = $singleMessage->getCreationDate();
        $username = $singleMessage->username;

        echo "Wiadomosc:<br>";
        echo "wyslana do: " . "$username" . " | data: " . "$creationDate";
        echo '<br>' . "$content";
        break;

    

    default:
        echo 'Blad, nie mozna wyswietlic wiadomosci';
}
?>
<br><br><a href="messages.php">Powrot</a><br><br>