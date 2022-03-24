<?php
require 'bdd.php';
if (!empty($_POST['Id']) && ctype_digit($_POST['Id'])) {
  //MODIFIER
  $colonne = $_POST;
  unset($colonne['envoyer']);
  $colonneName = array_keys($colonne);

  foreach ($colonneName as $colonneName2) {
    $result[] = $colonneName2 . "=:" . $colonneName2;
  }
  $colonne1 = implode(",", $result);
  $id = $_POST['Id'];

  $sth = $pdo->prepare("UPDATE historique SET $colonne1 WHERE Id=$id");
  foreach ($colonne as $key => &$value) {
    $sth->bindParam(':' . $key, $value);
  }
  $sth->execute();
  header('Location:index.php');

} elseif (isset($_POST['envoyer'])) {
    try {
    //AJOUTER
    
    unset($_POST['envoyer'], $_POST['Id'], $_POST['message_id']);

    // $user_id=$_SESSION['user_id']; 

    //Récupérer les clés dans un tableau
    $colonneName = array_keys($_POST);
    //Transforme le tableau en chaîne de caractère en y ajoutant une "," entre chaque élément
    $colonne1 = implode(",", $colonneName);
    $colonne2 = implode(",:", $colonneName);
    $colonne2 = ":" . $colonne2;

    error_log(print_r($colonne1,1));
    error_log(print_r($colonne2,1));


    $sth = $pdo->prepare("INSERT INTO historique ($colonne1) VALUES ($colonne2)");

    error_log("INSERT INTO message ($colonne1) VALUES ($colonne2)");
    //Parcour un tableau associatif
    foreach ($_POST as $key => &$value) {
      error_log($key." => " .$value);
      //error_log(print_r($key, 1));

      $sth->bindParam(':' . $key, $value);
    }
    $sth->execute();


    header('Location:index.php');
  }catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";

} 
  }else {

    echo 'erreur';
  }

