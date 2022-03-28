<?php
require 'bdd.php';
function valid_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;  }

try {
//     // Connexion  



  if (empty($_SESSION['connecte'])) {
     header("location: connexion.php");
    echo "Identifiant ou mot de passe incorrect";


  }

  
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Message</title>
</head>

<body>
<button class="btn btn-secondary"><a href="deconnexion.php">Deconnexion</a></button> 
<button class="btn btn-secondary"><a href="index.php">Accueil</a></button>


<?php
 if (!empty($_GET['id']) && isset($_GET['id'])) {

    echo "<h1>Votre message</h1>";}
    else {
        echo "<h1>Pas de changement reconnu</h1>";

    }
    //echo $_SESSION['user_id'];
?>

    <div class="container">
        <div class="message">
        <form class="" action=""  method="post">
        <!--<input type="hidden" name="Id" value="<?php //echo $result['Id']; ?>">!-->
      
            <div class="">
                <label for="message">Entrez votre message</label>
                <textarea onkeyup="valid(this.value)" class="" id="message" pattern="#^[A-Za-zéè '-]+$#" name="message" rows="5" cols="33" placeholder="Votre message"></textarea>
            </div>

            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">

            <div class="">
                <button class="btn btn-secondary" type="submit" name="envoyer" value="envoyer">Envoyer</button>
                </div>
                <a href="index.php"><button>Retour</button></a>
        </form>

     
        </div>
    </div>



    <?php 
}



catch (PDOException $e) {
   echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
} 

try {
if (isset($_POST['envoyer'])) {
  
    //AJOUTER
    
    unset($_POST['envoyer'], $_POST['Id']);

    // $user_id=$_SESSION['user_id']; 

    //Récupérer les clés dans un tableau
    $colonneName = array_keys($_POST);
    //Transforme le tableau en chaîne de caractère en y ajoutant une "," entre chaque élément
    $colonne1 = implode(",", $colonneName);
    $colonne2 = implode(",:", $colonneName);
    $colonne2 = ":" . $colonne2;

    error_log(print_r($colonne1,1));
    error_log(print_r($colonne2,1));


    $sth = $pdo->prepare("INSERT INTO message ($colonne1) VALUES ($colonne2)");

    error_log("INSERT INTO message ($colonne1) VALUES ($colonne2)");
    //Parcour un tableau associatif
    foreach ($_POST as $key => &$value) {
      error_log($key." => " .$value);
      
      $sth->bindParam(':' . $key, valid_donnees($value));
    }
    $sth->execute();

    $result=$pdo->lastInsertId();
    echo $result;
    $id= $_GET['id'];

    $sth = $pdo->prepare("UPDATE historique SET message_id= :message_id WHERE Id=$id");
  
    $sth->bindParam(':message_id',$result);
    $sth->execute();

    header('Location:index.php');

}

  }
  
  catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";

} 
  
?>
</body>
</html>
<script src="script.js"></script>