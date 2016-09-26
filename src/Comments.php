<?php

class Comments {

    private $id;
    private $user_id;
    private $tweet_id;
    private $content;
    private $creation_date;

    public function __construct() {
        $this->id = -1;
        $this->user_id = "";
        $this->tweet_id = "";
        $this->content = "";
        $this->creation_date = date('Y-m-d H:i:s');
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($UserId) {
        $this->user_id = $UserId;
        return $this->user_id;
    }

    public function getTweetId() {
        return $this->tweet_id;
    }

    public function setTweetId($tweetId) {
        $this->tweet_id = $tweetId;
        return $this->tweet_id;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($newContent) {
        $this->content = $newContent;
        return $this->content;
    }

    public function getCreationDate() {
        return $this->creation_date;
    }

    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {

            $sql = "INSERT INTO Comments(user_id, tweet_id, content, creation_date) VALUES ('$this->user_id', '$this->tweet_id', '$this->content', '$this->creation_date')";

            $result = $connection->query($sql);

            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        }
        return false;
    }

    static public function loadCommentsByTweetId(mysqli $connection, $getId) {

        $sql = "SELECT * FROM Tweets JOIN Users ON Tweets.user_id = Users.id JOIN Comments ON Comments.tweet_id = Tweets.id WHERE tweet_id=$getId ORDER BY Comments.creation_date DESC";
        $ret = [];
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows > 0) {

            foreach ($result as $row) {

                $loadedComments = new Comments();

                $loadedComments->id = $row['id'];
                $loadedComments->user_id = $row['user_id'];
                $loadedComments->tweet_id = $row['tweet_id'];
                $loadedComments->content = $row['content'];
                $loadedComments->creation_date = $row['creation_date'];
                $loadedComments->username = $row['username'];

                $ret[] = $loadedComments;
            }
        }

        return $ret;
    }

}
