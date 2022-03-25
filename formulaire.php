<?php
require 'bdd.php';
   

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
    <title>Formulaire</title>
</head>

<body>
<button class="btn btn-secondary"><a href="deconnexion.php">Deconnexion</a></button> 
<button class="btn btn-secondary"><a href="index.php">Accueil</a></button>


<?php
 if (!empty($_GET['id']) && isset($_GET['id'])) {

    echo "<h1>Modifier un changement</h1>";}
    else {
        echo "<h1>Ajouter un changement</h1>";

    }
    //echo $_SESSION['user_id'];
?>

    <div class="container">
        <form class="row g-3" action="ajout.php"  method="post">
        <input type="hidden" name="Id" value="<?php echo $result['Id']; ?>">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
       
            <div class="col-md-6">
                <label for="etage">Etage</label>
                <select name="Etage" value="<?php echo $result['Etage'];?>"  id="etage">
            <?php if (!empty($_GET['id']) && isset($_GET['id'])) { echo "<option >".$result['Etage']."</option>";} else {echo "<option disabled selected hidden>Etage</option>";}?>
                    <option value="RDC">RDC</option>
                    <option value="1er étage">1er étage</option>
                    <option value="2e étage">2e étage</option>
                    <option value="3e étage">3e étage</option>
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


            <div class="col-6">
                <label for="position">Position</label>
                <select name="Position" value="<?php echo $result['Position'];?>" id="Position">
                <?php if (!empty($_GET['id']) && isset($_GET['id'])) { echo "<option >".$result['Position']."</option>";} else {echo "<option disabled selected hidden>Position</option>";} ?>
                    <option value="Côté gauche">Côté gauche</option>
                    <option value="Côté droit">Côté droit</option>
                    <option value="fond">Fond</option>

                </select>
            </div>

            <div class="col-6">
                <label for="prix">Prix</label>
                <input type="number" class="" id="prix" name="Prix" value="<?php echo $result['Prix']; ?>" placeholder="prix">
            </div>

            <div class="col-md-6">
                <label for="date">Date de changement </label>
                <input type="date" class="" id="date" name="Date"  value="<?php echo $result['Date']; ?>" placeholder="date">
            </div>

            <div class="col-6">
                <button class="btn btn-secondary" type="submit" name="envoyer" value="envoyer">Envoyer</button>
                </div>
        </form>
    </div>



    <?php 
}



catch (PDOException $e) {
   echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
} ?>
</body>



</html>



