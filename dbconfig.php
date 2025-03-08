<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

function connectDB(){
    $database = "anicho13";
    $user = "anicho13";
    $pass = "trombone";
    $host = "localhost";
    try {
        $db = new PDO("mysql:host=$host;dbname=$database", $user, $pass);
        }
    catch (PDOException $e) {echo $e;}
    return $db; } ?>