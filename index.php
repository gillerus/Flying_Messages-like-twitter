<?php

include 'src/database.php';
include 'src/Users.php';

$conn = DataBase::conn();

$basia = Users::loadUserById($conn, 3);
var_dump($basia);
//$basia->setUsername('Jola');
//$basia->setPassword('ad2min1');
//$basia->setEmail('barbara12RR@wp.pl');
////
//var_dump($basia);
//
$basia->deleteUser($conn);
//        
var_dump($basia);

//$test = Users::loadUserById($conn, 1);

//$test = Users::loadAllUsers($conn);
//
//var_dump($test);

DataBase::closeConn($conn);