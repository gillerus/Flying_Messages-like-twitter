<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include 'src/database.php';
include 'src/Tweets.php';
include 'src/Comments.php';

$conn = DataBase::conn();
$singleTweet = Tweets::loadTweetsById($conn, $_GET['id']);
DataBase::closeConn($conn);

$getId = $_GET['id'];

$displayContnet = $singleTweet->getContent();
$craetionDate = $singleTweet->getCreationDate();

echo $displayContnet;
echo '<br/>';
echo 'Dodany przez uzytkownika: <a href="userProfil.php?id=' . $singleTweet->getUserId() . '">' . $singleTweet->username . '</a>' . " " . $craetionDate;
echo '<br><br>';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newComment = new Comments();
    $newComment->setUserId($_SESSION['loggedUseerId']);
    $newComment->setContent($_POST['newComment']);
    $newComment->setTweetId($_GET['id']);

    $conn = DataBase::conn();
    $newComment->saveToDB($conn);
    DataBase::closeConn($conn);

    header("Location: tweet.php?id=$getId");
}
?>
<div>
    <form action="#" method="post">
        <input type="text" size="30" name="newComment">
        <br><br>
        <input type="submit" value="Skomentuj">
    </form>

</div>
<br><a href="index.php">Powrot</a><br><br>
<?php
$conn = DataBase::conn();
$allComments = Comments::loadCommentsByTweetId($conn, $getId);
DataBase::closeConn($conn);

foreach ($allComments as $row) {
    $displayContnet = $row->getContent();
    $craetionDate = $row->getCreationDate();
    var_dump($row);

    echo $displayContnet;
    echo '<br/>';
    echo 'Dodany przez uzytkownika: <a href="userProfil.php?id=' . $row->getUserId() . '">' . $row->username . '</a>' . " " . $craetionDate;
    echo '<br/><br/>';
}
?>