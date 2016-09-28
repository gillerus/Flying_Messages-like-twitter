<?php

class Messages {

    private $id;
    private $sender_id;
    private $reciver_id;
    private $content;
    private $readm;
    private $creation_date;

    public function __construct() {
        $this->id = -1;
        $this->sender_id = "";
        $this->reciver_id = "";
        $this->content = "";
        $this->readm = false;
        $this->creation_date = date('Y-m-d H:i:s');
    }

    public function getId() {
        return $this->id;
    }

    public function getSenderId() {
        return $this->sender_id;
    }

    public function setSenderId($sender_id) {
        $this->sender_id = $sender_id;
        return $this->sender_id;
    }

    public function getReciverId() {
        return $this->reciver_id;
    }

    public function setReciverId($reciver_id) {
        $this->reciver_id = $reciver_id;
        return $this->reciver_id;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($newContent) {
        $this->content = $newContent;
        return $this->content;
    }

    public function getReadm() {
        return $this->readm;
    }

    public function setReadm(mysqli $connection, $id) {
        $sql = "UPDATE Messages SET readm=1 WHERE id=$id";
        $connection->query($sql);
      
        $this->readm = true;
        return $this->readm;
    }

    public function getCreationDate() {
        return $this->creation_date;
    }

    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {

            $sql = "INSERT INTO Messages(sender_id, reciver_id, content, readm, creation_date) VALUES ('$this->sender_id', '$this->reciver_id', '$this->content','$this->readm', '$this->creation_date')";

            $result = $connection->query($sql);

            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        }
        return false;
    }

    public function checkResiverId(mysqli $connection, $reciver) {

        $sql = "SELECT * FROM Users WHERE Users.username=" . "'" . $reciver . "'";

        $result = $connection->query($sql);

        if ($result == true) {
            $row = $result->fetch_assoc();
            return $row['id'];
        }
    }

    static public function loadMessagesBySenderId(mysqli $connection, $senderId) {

        $sql = "SELECT * FROM Users JOIN Messages ON Messages.reciver_id = Users.id WHERE Messages.sender_id=$senderId ORDER BY Messages.creation_date DESC";
        $ret = [];
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows > 0) {

            foreach ($result as $row) {

                $loadedMessages = new Messages();

                $loadedMessages->id = $row['id'];
                $loadedMessages->sender_id = $row['sender_id'];
                $loadedMessages->reciver_id = $row['reciver_id'];
                $loadedMessages->content = $row['content'];
                $loadedMessages->readm = $row['readm'];
                $loadedMessages->creation_date = $row['creation_date'];
                $loadedMessages->username = $row['username'];

                $ret[] = $loadedMessages;
            }
        }

        return $ret;
    }

    static public function loadMessagesByReciverId(mysqli $connection, $reciverId) {

        $sql = "SELECT * FROM Users JOIN Messages ON Messages.sender_id = Users.id WHERE Messages.reciver_id=$reciverId ORDER BY Messages.creation_date DESC";
        $ret = [];
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows > 0) {

            foreach ($result as $row) {

                $loadedMessages = new Messages();

                $loadedMessages->id = $row['id'];
                $loadedMessages->sender_id = $row['sender_id'];
                $loadedMessages->reciver_id = $row['reciver_id'];
                $loadedMessages->content = $row['content'];
                $loadedMessages->readm = $row['readm'];
                $loadedMessages->creation_date = $row['creation_date'];
                $loadedMessages->username = $row['username'];

                $ret[] = $loadedMessages;
            }
        }

        return $ret;
    }

    static public function loadSendMessage(mysqli $connection, $id) {

        $sql = "SELECT * FROM Messages JOIN Users ON Users.id = Messages.reciver_id WHERE Messages.id=$id";
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedMessages = new Messages();

            $loadedMessages->id = $row['id'];
            $loadedMessages->sender_id = $row['sender_id'];
            $loadedMessages->reciver_id = $row['reciver_id'];
            $loadedMessages->content = $row['content'];
            $loadedMessages->readm = $row['readm'];
            $loadedMessages->creation_date = $row['creation_date'];
            $loadedMessages->username = $row['username'];

            return $loadedMessages;
        }
        return null;
    }

    static public function loadRecivedMessage(mysqli $connection, $id) {

        $sql = "SELECT * FROM Messages JOIN Users ON Users.id = Messages.sender_id WHERE Messages.id=$id";
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedMessages = new Messages();

            $loadedMessages->id = $row['id'];
            $loadedMessages->sender_id = $row['sender_id'];
            $loadedMessages->reciver_id = $row['reciver_id'];
            $loadedMessages->content = $row['content'];
            $loadedMessages->readm = $row['readm'];
            $loadedMessages->creation_date = $row['creation_date'];
            $loadedMessages->username = $row['username'];

            return $loadedMessages;
        }
        return null;
    }

}
