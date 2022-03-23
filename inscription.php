<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    
    <title>Document</title>
</head>
<body>
<div class="container">  
  <h1>Inscription</h1>
<form class="row g-3" action="" method="post" name="form" id="form" >
            <div class="col-md-12">

              <label for="identifiant" class="form-label">Identifiant</label>
              <input type="text" pattern="^[A-Za-z '-]+$"  maxlength="20" class="form-control" name="Login" id="identifiant" placeholder="Entrer votre identifiant" required>
            </div>
          
            <div class="col-md-6">
              <label for="motdepasse" class="form-label">Mot de passe</label>
              <input type="password" requierd pattern="^[A-Za-z '-]+$"  maxlength="20" class="form-control" name="password" id="password"  placeholder="Entrer le mot de passe" required>
            </div>

            <div class="col-md-6">
              <label for="motdepasse" class="form-label">Confirmer le mot de passe</label>
              <input type="password" requierd pattern="^[A-Za-z '-]+$"  maxlength="20"  class="form-control" name="passwordconf" onblur="verif()"  id="passwordconf" placeholder="Confirmer votre mot de passe" required>
              
            </div>
            <a  class="mdp" href="">Mot de passe oublié</a>
     

            <div class="col-md-6">
              <label for="Email" class="form-label">Email</label>
              <input type="email"  class="form-control" name="Email" id="Email" placeholder="Entrer l'email" required>
            </div>

            <div class="col-md-6">
              <label for="Telephone" class="form-label">Telephone</label>
              <input type="tel"  maxlength="10" class="form-control" name="Tel" id="Telephone" placeholder="Entrer le numéro de téléphone" required>
            </div>

            <div class="col-md-6">
            <input  type="submit" name='submit' id='submit' value='CONNEXION'>
            <button class="btn btn-secondary"><a href="index.php">Retour</a></button>
            </div>
          </form>
          </div>

<?php 

require 'bdd.php' ;
//$password=password_hash($_POST['Password'],PASSWORD_DEFAULT);
if (isset($_POST['password'])){
$_POST['password']=password_hash($_POST['password'],PASSWORD_DEFAULT);
//echo $password;
$colonne = $_POST;
  unset($colonne['submit'], $colonne['Id'], $colonne['passwordconf']);
  //error_log(print_r($colonne,1));

  //Récupérer les clés dans un tableau
  $colonneName = array_keys($colonne);
  //error_log(print_r($colonneName,1));
  //Transforme le tableau en chaîne de caractère en y ajoutant une "," entre chaque élément
  $colonne1 = implode(",", $colonneName);
  $colonne2 = implode(",:", $colonneName);
  $colonne2 = ":" . $colonne2;

  echo $colonne1;
  echo $colonne2;
  
  if (isset($_POST['submit'])) {

    $sth = $pdo->prepare("INSERT INTO user ($colonne1) VALUES ($colonne2)");
    //Parcour un tableau associatif
    foreach ($colonne as $key => &$value) {
    
        $sth->bindParam(':' . $key, $value);
      }
     
   // }
    $sth->execute();
   // header('Location: index.php');
  } else {

    'erreur';
  }}




?>

<script src="script.js"> </script>
</body>
</html>
