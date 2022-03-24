<?php
require 'bdd.php';

try {
  // Connexion  

  // error_log("SESSION : ".print_r($_SESSION, 1));

  if (!isset($_SESSION['connecte'])) {
    header("location: connexion.php");
    //   // echo "Identifiant ou mot de passe incorrect";


  }

  //Récupérer le nombre d'enregistrements
  $count = $pdo->prepare("SELECT count(Id) as cpt  FROM historique");
  $count->setFetchMode(PDO::FETCH_ASSOC);
  $count->execute();
  $tcount = $count->fetchAll();

  //Pagination 
  @$page = $_GET["page"];
  if (empty($page)) $page = 1;
  $nbr_elements_par_page = 4;
  $nbr_de_pages = ceil($tcount[0]["cpt"] / $nbr_elements_par_page);
  $debut = ($page - 1) * $nbr_elements_par_page;

  $sth = $pdo->prepare("SELECT * FROM historique LIMIT $debut, $nbr_elements_par_page");
  $sth->execute();
  $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);


?>

  <!DOCTYPE html>
  <html lang="fr">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
  </head>

  <body>
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <button class="btn btn-secondary"><a href="deconnexion.php">Deconnexion</a></button>


    <div class="container-fluid">
      <div class="entete">

<form action="recherche.php" method="post">
  <label for="recherche">Recherche</label>
<input type="search" name="search" >
<button name="envoyer">Envoyer</button>

</form>

        <h1>Changement d'ampoules</h1>
        <header><?= $tcount[0]["cpt"]; ?> Enregistrements au total</header>

        <div class="pagination">
          <?php
          for ($i = 1; $i <= $nbr_elements_par_page; $i++) {
            if ($page != $i) {


              echo "<a href='?page=$i'>$i</a>&nbsp";
            } else {
              echo "<a>$i</a>&nbsp";
            }
          }
          ?>
        </div>
      </div>
      <div class="tableau">
        <table>
          <tr>
            <th scope="col">Etage</th>
            <th scope="col">Position</th>
            <th scope="col">Prix</th>
            <th scope="col">Date</th>
            <th scope="col">Suppression</th>
            <th scope="col">Modification</th>
            <th scope="col">Message</th>

          </tr>
          <?php for ($i = 0; $i < count($resultat); $i++) { ?>

            <tr>
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
          $(function() {
            toastr.success('<b>Changement supprimé !</b>', 'Supprimer', {
              positionClass: "toast-top-full-width",
              "closeButton": false,
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": true,
              "positionClass": "toast-top-full-width",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            });
          });
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