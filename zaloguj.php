<?php

session_start();

require 'src/database.php';

$conn = DataBase::conn();

$email = $_POST['email'];
$password = $_POST['password'];

if (isset($email) && isset($password)) {

    $sql = 'SELECT * FROM Users WHERE email="' . $email . '"';

    $result = $conn->query($sql);
    $user_amm = $result->num_rows;

    $row = $result->fetch_assoc();

    if (password_verify($password, $row['hashedPassword'])) {

        $_SESSION['username'] = $row['username'];
        $_SESSION['loggedUseerId'] = $row['id'];

        unset($_SESSION['error']);
        $result->free_result();

        header('location: index.php');
    } else {
        $_SESSION['error'] = '<img src="http://www.rtve.es/imagenes/usuarios/avatar/19126567.png" width="16"><span style="color:red"><b> Nieprawidłowy login lub hasło!</b></span>';
        header('location: login.php');
    }
}
DataBase::closeConn($conn);

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}