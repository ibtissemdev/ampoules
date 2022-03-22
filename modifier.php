<?php
 require 'bdd.php';


 $colonne = $_POST; 
 unset($colonne['envoyer']);
 $colonneName=array_keys($colonne);


 foreach($colonneName as $colonneName2){
  $result[]=$colonneName2."=:".$colonneName2;
 }
 $colonne1=implode(",", $result);
$id=$_POST['Id'];
print_r($id);
 if ( !empty($_POST['Id']) && ctype_digit($_POST['Id'])){

  $sth = $pdo->prepare("UPDATE historique SET $colonne1 WHERE Id=$id");
  foreach ($colonne as $key => &$value) {
    $sth->bindParam(':'. $key, $value);
  }

  $sth->execute();
  echo "ok";
 } else {

    'erreur'; 
}


<?php
require 'bdd.php';

try {

    if (!empty($_GET['id']) && isset($_GET['id'])) {

        $sth = $pdo->prepare("SELECT * From historique where Id= :id");
        $sth->bindValue(":id", $_GET['id']);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
//print_r($_GET['id']); 
print_r($result);
    } 
} catch (PDOException $e) {
    echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
}


    
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>

<body>
<?php echo $result['Date'];?>
<h1>Ajouter ou modifier un changement</h1>
    <div class="container">
        <form action="ajout.php" method="post">
        <input type="hidden" name="Id" value="<?php echo $result['Id']; ?>">
        <div class="">
                <label for="date">Date de changement </label>
                <input type="date" class="" id="date" name="Date"  value="<?php echo $result['Date']; ?>" placeholder="date">
            </div>
            <div class="">
                <label for="etage">Etage</label>
                <select name="Etage"  id="etage">
                    <option value="<?php echo $result['Etage'];?>" disabled selected hidden><?php echo $result['Etage'];?></option>
                    <option value="RDC">RDC</option>
                    <option value="1er étage">1er étage</option>
                    <option value="2e étage">2e étage</option>
                    <option value="3">2e étage</option>
                    <option value="4e étage">4e étage</option>
                    <option value="5e étage">5e étage</option>
                    <option value="6e étage">6e étage</option>
                    <option value="7e étage">7e étage</option>
                    <option value="8e étage">8e étage</option>
                    <option value="9e étage">9e étage</option>
                    <option value="10e étage">10e étage</option>
                    <option value="11e étage">11e étage</option>
                </select>

            </div>


            <div class="">
                <label for="position">Position</label>
                <select name="Position"  id="etage">
                    <option value="<?php echo $result['Position'];?>" disabled selected hidden>Position</option>
                    <option value="gauche">Côté gauche</option>
                    <option value="droite">Côté droit</option>
                    <option value="fond">Fond</option>

                </select>
            </div>

            <div class="">
                <label for="prix">Prix</label>
                <input type="number" class="" id="prix" name="Prix" value="<?php echo $result['Prix']; ?>" placeholder="prix">
            </div>
            <div class="">

                <button type="submit" name="envoyer" value="envoyer">Ajouter</button>
                </div>
        </form>
    </div>




</body>

</html>



<?php




?>

/*

try {

$password = '$2y$14$sP9VIC8upHFqwq/s0A8z9upNWfMhLwc8JB7ncIC9DW/RiuXVjxYsa';

/*$admin = @$_POST["Login"];
$motdepasse = password_verify(@$_POST["Password"], $password);*/

//echo password_hash($motdepasse,PASSWORD_DEFAULT); 



//$util = "SELECT * From user where Login='$admin' and Password='$motdepasse'";
/*$sth = $pdo->prepare($util);
$sth->execute();
$result = $sth->fetch();
$_SESSION['result']=$result;

if (empty($_SESSION['result']) )
    {

echo "Veuillez entrer votre mot de passe !";


}

else {
   
//echo 'connexion réussie '; 

  header("location:index.php");
}

}


catch (PDOException $e) {
    echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
}
