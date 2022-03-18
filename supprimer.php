<?php
require 'bdd.php';

print_r($_GET);


if ( !empty($_GET['id']) && ctype_digit($_GET['id'])){
    $sql = "DELETE FROM historique WHERE Id= ".$_GET['id'];
    $sth = $pdo->prepare($sql);
    $sth->execute();
    
    header('Location:index.php');

}




?>