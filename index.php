<?php
require 'bdd.php';

try {
  // Connexion  

  // error_log("SESSION : ".print_r($_SESSION, 1));

  if (!isset($_SESSION['connecte'])) {
    header("location: connexion.php");
    //   // echo "Identifiant ou mot de passe incorrect";

 
  } else {
                $sth = $pdo->prepare("SELECT Login From user WHERE Id = :id ");
                $sth->bindValue(':id', $_SESSION['user_id']);
                $sth->execute();
                $result = $sth->fetch();     
  }

 
      

  //Récupérer le nombre d'enregistrements
  $count = $pdo->prepare("SELECT count(Id) as cpt  FROM historique");
  $count->setFetchMode(PDO::FETCH_ASSOC);
  $count->execute();
  $tcount = $count->fetchAll();

  //Pagination 
  @$page = $_GET["page"];
  if (empty($page)) $page = 1;
  $nbr_elements_par_page =3;

  $nbr_de_pages = ceil($tcount[0]["cpt"] / $nbr_elements_par_page);
  $debut = ($page - 1) * $nbr_elements_par_page;

  $sth = $pdo->prepare("SELECT * FROM historique LIMIT $debut, $nbr_elements_par_page");
  $sth->execute();
  $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
  print_r($resultat);

  //Sélectionne le login dans la table user qui a le même Id que dans la table hostorique
$sth = $pdo->prepare("SELECT Login From user INNER JOIN historique ON historique.user_id=user.Id LIMIT $debut, $nbr_elements_par_page");
$sth->execute();
$result2 = $sth->fetchAll();
error_log(print_r($result2,1));
//echo 'result : ',print_r($result); 

?>

  <!DOCTYPE html>
  <html lang="fr">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Accueil</title>
  </head>

  <body>
  <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
   
    <div class="utilisateur">
    <p class='operateur'> Opérateur : <?php echo $result ['Login']?> </p>
    <button class="btn btn-secondary"><a href="deconnexion.php">Deconnexion</a></button>
    </div>

    <div class="container-fluid">
      <div class="entete">
      <h1>Changement d'ampoules</h1>
<form action="recherche.php" method="post">
  <label for="recherche">Recherche</label>
<input type="search" name="search" >
<button name="envoyer">Envoyer</button>

</form>

      
        <header><?= $tcount[0]["cpt"]; ?> Enregistrements au total</header>

        <div class="pagination">
          <?php
         
            $precedent=$page-1;
            if ($page>1){
              echo"<a href='?page=$precedent'>Précédent</a>&nbsp";
          
        }else {
          echo "<a>précédent</a>&nbsp";
        }

          for ($i = 1; $i <=$nbr_de_pages; $i++) {
            if ($page != $i) {

              echo "<a href='?page=$i'>$i</a>&nbsp";
            } else {
              echo "<a>$i</a>&nbsp";
             
            }
          }
         
          $suivant=$page+1;
          if ($suivant<=$nbr_de_pages){
            echo "<a href='?page=$suivant'>Suivant</a>&nbsp";
          } else {
            echo "<a>Suivant</a>&nbsp";
          }
         
          ?>
        </div>
      </div>
      <div class="tableau">
        <table>
          <tr>
          <th scope="col">Opérateur</th>
            <th scope="col">Etage</th>
            <th scope="col">Position</th>
            <th scope="col">Prix</th>
            <th scope="col">Date</th>
            <th scope="col">Suppression</th>
            <th scope="col">Modification</th>
            <th scope="col">Message</th>

          </tr>
          <?php for ($i = 0; $i < count($result2); $i++) { ?>

            <tr>
              <td><?php echo $result2[$i]['Login']  ?></td>
              <td><?php echo $resultat[$i]["Etage"] ?></td>
              <td><?php echo $resultat[$i]["Position"] ?></td>
              <td><?php echo $resultat[$i]["Prix"] ?></td>
              <td><?php echo $resultat[$i]["Date"] ?></td>
              <td><a href="supprimer.php?id=<?php echo $resultat[$i]['Id']; ?>"><button class="btn btn-secondary" onclick="return confirm('Voulez-vous supprimer ?')">Supprimer</button></a></td>
              <td><a href="formulaire.php?id=<?php echo $resultat[$i]['Id']; ?>"><button class="btn btn-secondary" name="modifier" value="modifier">Modifier</button></a></td>
              <td><a href="message.php?id=<?php echo $resultat[$i]['Id']; ?>"><button class="btn btn-secondary" name="modifier" value="modifier">Message</button></a></td>
            </tr>
          <?php } ?>

        </table>
      </div>

      <div class="ajouter"><button class="btn btn-info"><a href="formulaire.php">Ajouter</a></button></div>



      <?php
     if (isset($_SESSION['supprimer']) && $_SESSION['supprimer'] == true) { ?>
        <script type="text/javascript">
         
          var notyf = new Notyf({
  duration: 3000,
  position: {
    x: 'center',
    y: 'top',
  }
});

notyf.success('Le changement a bien été supprimé');

        </script>
      <?php }
      $_SESSION['supprimer'] = false;
    ?>

    <?php
  } catch (PDOException $e) {
    echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
  } ?>

    </div>
  </body>

  </html>