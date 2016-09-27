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

echo "Skrzynka prywatnych wiadomosci uzytkownika: " . $_SESSION['username'];

echo '<br><br>';

$conn = database::Conn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $newMessage = new Messages();
    $newMessage->setSenderId($_SESSION['loggedUseerId']);
    $newMessage->setContent($_POST['newMessage']);
    $newMessage->setReciverId($newMessage->checkResiverId($conn, $_POST['reciver']));
    $newMessage->saveToDB($conn);
    DataBase::closeConn($conn);
}
?>
<div>
    Wyslij przywatna wiadomosc:<br><br>
    <form action="#" method="post">
        Do uzytkowniaka:<br>
        <input type="text" size="30" name="reciver"><br>
        Tresc:<br>
        <textarea name="newMessage" placeholder="Nawijaj ..."></textarea>
        <br><br>
        <input type="submit" value="Send">
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo '<p style="color: blue;">wiadomosc wyslana :)</p>';
    }
    ?>
</div>
<br><a href="messages.php">Powrot</a><br><br>
<?php
//    echo '<br/>';
//    echo 'Dodany przez uzytkownika: <a href="userProfil.php?id=' . $row->getUserId() . '">' . $row->username . '</a>' . " " . $craetionDate;
//    echo '<br/><br/>';
?>