<?php 

require 'bdd.php';

if (isset($_POST['envoyer'])) {
$search=$_POST['search']; 

$sth=$pdo->prepare("SELECT message.date, message.message, user.Login FROM message INNER JOIN user ON user.id = message.user_id  WHERE MATCH (message) AGAINST('$search')");
$sth->execute();
$resultat=$sth->fetchall();
//var_dump($search);
}
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
<div class="tableau">
        <table>
          <tr>
            <th scope="col">Date du message</th>
            <th scope="col">Texte du message</th>
            <th scope="col">Auteur</th>
           
          </tr>
          <?php for ($i = 0; $i < count($resultat); $i++) { ?>

            <tr>
              <td><?php echo $resultat[$i]["date"] ?></td>
              <td><?php echo $resultat[$i]["message"] ?></td>
              <td><?php echo $resultat[$i]["Login"] ?></td>
           
              
            </tr>
            <?php }?>
        </table>
      </div>

    </body>

</html>
