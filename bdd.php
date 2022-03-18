<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ampoules";
$port='3306';
$charset="utf8mb4";
$conn="mysql:host=$servername;dbname=$dbname;port=$port;charset=$charset";

try {
$pdo = new \PDO($conn,$username);


$sth = $pdo->prepare("SELECT * FROM historique");
  $sth->execute();
  $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);


  


//print_r($resultat);
}

catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), $e->getCode());

}

try {

    if (!empty($_GET['id']) && isset($_GET['id'])) {

        $sth = $pdo->prepare("SELECT * From historique where Id= :id");
        $sth->bindValue(":id", $_GET['id']);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
//print_r($_GET['id']); 

    } 
} catch (PDOException $e) {
    echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
}
