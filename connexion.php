<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">  
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
              <label for="Email" class="form-label">Email</label>
              <input type="email"  class="form-control" name="Email" id="Email" placeholder="Entrer l'email" required>
            </div>

            <div class="col-md-6">
              <label for="Telephone" class="form-label">Telephone</label>
              <input type="tel"  maxlength="10" class="form-control" name="Tel" id="Telephone" placeholder="Entrer le numéro de téléphone" required>
            </div>

            <div class="col-md-6">
            <input type="submit" name='submit' id='submit' value='CONNEXION'>
            </div>
         



          </form>
          </div>

</body>
</html>

<?php 

require 'bdd.php' ;
//$password=password_hash($_POST['Password'],PASSWORD_DEFAULT);
$_POST['Password']=password_hash($_POST['Password'],PASSWORD_DEFAULT);
//echo $password;
$colonne = $_POST;
  unset($colonne['submit'], $colonne['Id']);
  //error_log(print_r($colonne,1));

  //Récupérer les clés dans un tableau
  $colonneName = array_keys($colonne);
  //error_log(print_r($colonneName,1));
  //Transforme le tableau en chaîne de caractère en y ajoutant une "," entre chaque élément
  $colonne1 = implode(",", $colonneName);
  $colonne2 = implode(",:", $colonneName);
  $colonne2 = ":" . $colonne2;
  
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
  }



/*$login='Ibtissem';
$password=password_hash('Decembre',PASSWORD_DEFAULT);

                $sth = $pdo->prepare("INSERT INTO user(Login,Password) VALUES (:Login,:Password)");
                //La constante de type par défaut est STR
                $sth->bindParam(':Login',$login);
                $sth->bindParam(':Password',$password);
                $sth->execute();
                echo "Entrée ajoutée dans la table";


//$password=password_hash('Decembre',PASSWORD_DEFAULT);*/


/*try {
  $_SESSION = array();
  if(isset($_POST['submit'])) {

    //$password='$2y$10$ovbkaB89wFFTBZusEjzMce.3P.KY./oKXGY4r3bvAIgJjwozqIpgW';

    $utilisateur = @$_POST["Login"];
    //$motdepasse = password_verify(@$_POST["Password"], $password);

    //error_log(password_hash('Decembre',PASSWORD_DEFAULT));
   // error_log(print_r($_POST, 1));
    //echo password_hash($motdepasse,PASSWORD_DEFAULT); 



    $util = "SELECT * From user where Login='$utilisateur'";

    //error_log($util);
    $sth = $pdo->prepare($util);
    $sth->execute();
    $result = $sth->fetch();

   // error_log(print_r($result, 1));
    if (password_verify(@$_POST["Password"],$utilisateur['Password'])==1) {
      $_SESSION['result']=$result;
     // error_log("Connection successful");
    }
  } else {
    //error_log("Connection NOT successful");
    //header("location:index.php");
  }


  if (empty($_SESSION['result']) ) {

    echo "Veuillez entrer votre mot de passe !";


  } else {
   
    //echo 'connexion réussie '; 
    $_SESSION['connecte'] = TRUE;
    header("location:index.php");

    //error_log("NEW SESSION ".print_r($_SESSION, 1));
  }
}


catch (PDOException $e) {
    echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
}*/


?>