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

echo 'Skrzynka pocztowa uzytkownika: ' . $_SESSION['username'];
echo '<br><br>';
?>
<div>
    <a href="singleMessage.php">Wyslij przywatna wiadomosc</a><br><br>


</div>
<br><a href="index.php">Powrot</a><br><br>
<?php
$conn = DataBase::conn();
$allSendMessages = Messages::loadMessagesBySenderId($conn, $_SESSION['loggedUseerId']);
DataBase::closeConn($conn);
echo '<hr>Wyslane wiadomosci<br>';
foreach ($allSendMessages as $row) {
    $id = $row->getId();
    $senderId = $row->getSenderId();
    $reciverId = $row->getReciverId();
    $content = $row->getContent();
    $creationDate = $row->getCreationDate();
    $messageRead = $row->getReadm();
    $username = $row->username;

    echo '<br>';
//    echo "Wiadomosc:<br>";
    echo "wyslana do: " . "$username" . " | data: " . "$creationDate";
    echo '<br>' . '<a href="messageDetails.php?id='.$id.'">' . substr($content, 0, 10) . '</a>' . "<br>";
}

$conn = DataBase::conn();
$allRecivedMessages = Messages::loadMessagesByReciverId($conn, $_SESSION['loggedUseerId']);
DataBase::closeConn($conn);
echo '<hr>Odebrane wiadomosci<br>';
foreach ($allRecivedMessages as $row) {
    $id = $row->getId();
    $senderId = $row->getSenderId();
    $reciverId = $row->getReciverId();
    $content = $row->getContent();
    $creationDate = $row->getCreationDate();
    $messageRead = $row->getReadm();
    $username = $row->username;

    echo '<br>';
//    echo "Wiadomosc:<br>";
    echo "przyslana przez: " . "$username" . " | data: " . "$creationDate";
    echo '<br>' . '<a href="messageDetails.php?id='.$id.'">' . substr($content, 0, 10) . '</a>' . "<br>";
}
?>