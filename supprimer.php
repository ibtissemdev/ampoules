<!DOCTYPE html>
  <html lang="fr">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <title>Document</title>
  </head>

  <body>
  <script src="http://code.jquery.com/jquery-2.0.3.min.js" ></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<?php
require 'bdd.php';



if ( !empty($_GET['id']) && ctype_digit($_GET['id'])){
    $sql = "DELETE FROM historique WHERE Id= ".$_GET['id'];
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $_SESSION['supprimer'] = TRUE;
    
   
    //sleep(3);
    header('Location:index.php');
}




?>