
  <?php
  require 'bdd.php';

  try {
    // Connexion  



 if (empty($_SESSION['result'])) {
     header("location: connexion.php");
     // echo "Identifiant ou mot de passe incorrect";


 }
 
 $sth = $pdo->prepare("SELECT * FROM historique");
 $sth->execute();
 $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
 
  





/*
echo '<a href="supprimer.php?id='.$resultat[$i]['Id'].'"><button   name="Id"  onClick="return Confirmer('Voulez-vous vraiment supprimer ?')" > Supprimer</button></a>';
  
  echo '<form name="supprimer" action="supprimer.php?id=" method="get"><button  value='.$resultat[$i]["Id"]. ' name="Id"  onClick="Confirmer()" > Supprimer</button></form> ';
  echo '<form action="" method="get"><button value='.$resultat[$i]["Id"]. ' name="Id"> Modifier</button></form> ';
*/

?>


  

  <!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

<button><a href="deconnexion.php">Deconnexion</a></button> 
<table>
  <?php for($i=0 ; $i<count($resultat) ; $i++) { ?>

    <tr>
      <td><?php echo $resultat[$i]["Etage"] ?></td>
      <td><?php echo $resultat[$i]["Position"] ?></td>
      <td><?php echo $resultat[$i]["Prix"] ?></td>
      <td><?php echo $resultat[$i]["Date"] ?></td>
      <td><a href="supprimer.php?id=<?php echo $resultat[$i]['Id'];?>"><button onclick="return confirm('Voulez-vous supprimer ?')">Supprimer</button></a></td>
      <td><a href="formulaire.php?id=<?php echo $resultat[$i]['Id'];?>"><button name="modifier" value="modifier" >Modifier</button></a></td>
    </tr>
  <?php } ?>
</table>


<!--<form name="supprimer" action="supprimer.php" method="get">
  <button value=<?=$resultat[$i]["Id"]?>  name="Id"   onClick="ConfirmerAge()"> Supprimer</button>
</form>-->
<button><a href="formulaire.php">Ajouter</a></button>

<script src="script.js"></script>

<?php 
}



catch (PDOException $e) {
   echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
} ?>
</body>

</html>