<?php

class Tweets {

    private $id;
    private $user_id;
    private $content;
    private $creation_date;

    public function __construct() {
        $this->id = -1;
        $this->user_id = "";
        $this->content = "";
        $this->creation_date = date('Y-m-d H:i');
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

            $sql = "INSERT INTO Tweets(user_id, content, creation_date) VALUES ('$this->user_id', '$this->content', '$this->creation_date')";

            $result = $connection->query($sql);

            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        }
        return false;
    }

    static public function loadTweetsById(mysqli $connection, $id) {

        $sql = "SELECT * FROM Tweets WHERE id=$id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();

            $loadedTweets = new Users();

            $loadedTweets->id = $row['id'];
            $loadedTweets->user_id = $row['user_id'];
            $loadedTweets->content = $row['content'];
            $loadedTweets->creation_date = $row['creation_date'];

            return $loadedTweets;
        }

        return null;
    }

    static public function loadAllTweets(mysqli $connection) {

        $sql = "SELECT * FROM Tweets JOIN Users ON Tweets.user_id = Users.id";
        $ret = [];
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows != 0) {

            foreach ($result as $row) {

                $loadedTweets = new Tweets();

                $loadedTweets->id = $row['id'];
                $loadedTweets->user_id = $row['user_id'];
                $loadedTweets->username = $row['username'];
                $loadedTweets->content = $row['content'];
                $loadedTweets->creation_date = $row['creation_date'];

                $ret[] = $loadedTweets;
            }
        }

        return $ret;
    }

    static public function loadTweetsByUserId(mysqli $connection, $user_id) {

        $sql = "SELECT * FROM Tweets WHERE user_id=$user_id";
        $ret = [];
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows > 0) {

            foreach ($result as $row) {

                $loadedTweets = new Tweets();

                $loadedTweets->id = $row['id'];
                $loadedTweets->user_id = $row['user_id'];
                $loadedTweets->content = $row['content'];
                $loadedTweets->creation_date = $row['creation_date'];

                $ret[] = $loadedTweets;
            }
        }

        return $ret;
    }

    public function deleteTweet(mysqli $connection) {

        if ($this->id != -1) {
            $sql = "DELETE FROM Tweets WHERE id=$this->id";
            $result = $connection->query($sql);

            if ($result == true) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

}
