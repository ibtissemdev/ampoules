<?php
require 'bdd.php';
   

try {
    // Connexion  



 if (empty($_SESSION['result'])) {
     header("location: connexion.php");
     // echo "Identifiant ou mot de passe incorrect";


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
<button><a href="deconnexion.php">Deconnexion</a></button> 
<button><a href="index.php">Accueil</a></button>
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
                <select name="Etage" value="<?php echo $result['Etage'];?>"  id="etage">
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
                <select name="Position" value="<?php echo $result['Position'];?>" id="etage">
                    <option value="Côté gauche">Côté gauche</option>
                    <option value="Côté droit">Côté droit</option>
                    <option value="fond">Fond</option>

                </select>
            </div>

            <div class="">
                <label for="prix">Prix</label>
                <input type="number" class="" id="prix" name="Prix" value="<?php echo $result['Prix']; ?>" placeholder="prix">
            </div>
            <div class="">

                <button type="submit" name="envoyer" value="envoyer">Envoyer</button>
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



