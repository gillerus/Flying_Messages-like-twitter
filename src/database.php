<?php

// get conn, close conn select, insert, update, delete;

class DataBase {

    static private $db_localhost = "localhost";
    static private $db_user = "root";
    static private $db_pass = "coderslab";
    static private $db_name = "twetter";

    public static function conn() {
        $conn = new mysqli(self::$db_localhost, self::$db_user, self::$db_pass, self::$db_name);
        
        if ($conn->connect_error) {
            die("Poloczenie nieudane. Blad: " . $conn->connect_errno);
        } else {
//            echo "Polaczenie udane";
            return $conn;
        }
    }

    public static function closeConn(mysqli $conn) {
        $conn->close();
        $conn = null;
        
        return true;
    }

}
