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
        extract($_GET); ?>
    <h1> <?= (isset($id) && !empty($id)) ? "Modifier ": "Ajouter"?> un changement</h1>

        <div class="container">
            <form class="row g-3" action="ajout.php" method="post">
                <input type="hidden" name="Id" value="<?= $result['Id']; ?>">
                <input type="hidden" name="table" value="historique">
                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">

                <div class="col-md-6">
                    <label for="etage">Etage</label>


                    <select name="Etage" value="<?= $result['Etage']; ?>" id="etage">
                        <?= (isset($id)) ?  "<option>" . $result['Etage'] . "</option>" : "<option disabled selected hidden>Etage</option>"; ?>
                        <option value="RDC">RDC</option>
                        <?php for ($i = 1; $i <= 11; $i++) : ?>
                            <option value="Etage <?= $i ?>">Etage <?= $i ?> </option>
                        <?php endfor ?>
                    </select>

                </div>

                <div class="col-6">
                    <label for="position">Position</label>
                    <select name="Position" value="<?= $result['Position']; ?>" id="Position">
                        <?= (isset($id))  ? "<option >" . $result['Position'] . "</option>" : "<option disabled selected hidden>Position</option>" ?>
                        <option value="Côté gauche">Côté gauche</option>
                        <option value="Côté droit">Côté droit</option>
                        <option value="fond">Fond</option>

                    </select>
                </div>

                <div class="col-6">
                    <label for="prix">Prix</label>
                    <input type="number" class="" id="prix" name="Prix" value="<?= $result['Prix']; ?>" placeholder="prix">
                </div>

                <div class="col-md-6">
                    <label for="date">Date de changement </label>
                    <input type="date" class="" id="date" name="Date" min="<?=date('Y-m-d')?>" value="<?= $result['Date']; ?>" placeholder="date">
                </div>

                <div class="col-6">
                    <button class="btn btn-secondary" type="submit" name="envoyer" value="envoyer">Envoyer</button>
                </div>
            </form>
        </div>
    <?php
} catch (PDOException $e) {
    echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
} ?>
    </body>

    </html>