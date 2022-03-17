<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ampoules";


// 
try {
    $pdo = new PDO("mysql:host=$servername", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
   echo "Erreur : " . $e->getMessage();
}