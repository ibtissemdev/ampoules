<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Formulaire</title>
</head>

<body>


<div class="container">  

<h1>Identification</h1>

<form class="row g-3" action="" method="post" >
            <div class="col-md-12">

              <label for="identifiant" class="form-label">Identifiant</label>
              <input type="text" requierd pattern="^[A-Za-z '-]+$"  maxlength="20" class="form-control" name="Login" id="identifiant" placeholder="Entrer votre identifiant" required>
            </div>
          
            <div class="col-md-6">
              <label for="motdepasse" class="form-label">Mot de passe</label>
              <input type="password" requierd pattern="^[A-Za-z '-]+$"  maxlength="20" class="form-control" name="Password" id="motdepasse" placeholder="Entrer le mot de passe" required>
            </div>
          
            <div class="col-md-6">
            <input type="submit" name='submit' id='submit' value='CONNEXION'>
            </div>
         
          </form>

          <button class="btn btn-secondary"><a href="inscription.php">Je n'ai pas de compte</a></button>
          </div>
</body>

<?php

require 'bdd.php';





//password=password_hash('Decembre',PASSWORD_DEFAULT);


try {
  $_SESSION = array();
  if(isset($_POST['submit'])) {

    //$password='$2y$10$ovbkaB89wFFTBZusEjzMce.3P.KY./oKXGY4r3bvAIgJjwozqIpgW';

    $utilisateur = @$_POST["Login"];
    //$motdepasse = password_verify(@$_POST["Password"], $password);

    //error_log(password_hash('Decembre',PASSWORD_DEFAULT));
    //error_log(print_r($_POST["Login"], 1));
    //echo password_hash($motdepasse,PASSWORD_DEFAULT); 



    $util = "SELECT * From user where Login='$utilisateur'";

    //error_log($util);
    $sth = $pdo->prepare($util);
    $sth->execute();
    $result = $sth->fetch();

    //echo '<pre>',print_r($result),'<pre>';

    error_log(print_r($_POST, 1));
    error_log(print_r($result, 1));

    if (password_verify(@$_POST["Password"],$result['Password'])==1) {
      $_SESSION['result']=$result;
     error_log("Connection successful");
    } else {
        error_log("Connection NOT successful");
        //header("location:index.php");
    }
  } 


  if (empty($_SESSION['result']) ) {

    echo "<p class='entrer'>Veuillez entrer votre mot de passe !</p>";


  } else {
   
    //echo 'connexion réussie '; 
    $_SESSION['connecte'] = TRUE;
    header("location:index.php");

    //error_log("NEW SESSION ".print_r($_SESSION, 1));
  }
}


catch (PDOException $e) {
    echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
}


?>

