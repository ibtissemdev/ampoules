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
} else {
  //AJOUTER
  $colonne = $_POST;
  unset($colonne['envoyer'], $colonne['Id']);

  //Récupérer les clés dans un tableau
  $colonneName = array_keys($colonne);
  //Transforme le tableau en chaîne de caractère en y ajoutant une "," entre chaque élément
  $colonne1 = implode(",", $colonneName);
  $colonne2 = implode(",:", $colonneName);
  $colonne2 = ":" . $colonne2;

  if (isset($_POST['envoyer'])) {

    $sth = $pdo->prepare("INSERT INTO historique ($colonne1) VALUES ($colonne2)");
    //Parcour un tableau associatif
    foreach ($colonne as $key => &$value) {
      $sth->bindParam(':' . $key, $value);
    }
    $sth->execute();
    header('Location:index.php');
  } else {

    'erreur';
  }
}

