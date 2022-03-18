<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="" method="post" class="">
            <div class="col-md-12">

              <label for="identifiant" class="form-label">Identifiant</label>
              <input type="text" requierd pattern="^[A-Za-z '-]+$"  maxlength="20" class="form-control" name="Login" id="identifiant" placeholder="Entrer votre identifiant" required>
            </div>
          
            <div class="col-12">
              <label for="motdepasse" class="form-label">Mot de passe</label>
              <input type="password" requierd pattern="^[A-Za-z '-]+$"  maxlength="20" class="form-control" name="Password" id="motdepasse" placeholder="Entrer le mot de passe" required>
            </div>
          
            <div class="col-12">
            <input type="submit" id='submit' value='CONNEXION'>
            </div>
         



          </form>


</body>
</html>

<?php 

require 'bdd.php' ;



try {

$admin = @$_POST["Login"];
$motdepasse = @$_POST["Password"];


$util = "SELECT * From user where Login='$admin' and Password='$motdepasse'";
$sth = $pdo->prepare($util);
$sth->execute();
$result = $sth->fetch();
$_SESSION['result']=$result;

if (empty($_SESSION['result']) )
    {

echo "Veuillez entrer votre mot de passe !";


}

else {
   
//echo 'connexion réussie '; 

  header("location:index.php");
}

}


catch (PDOException $e) {
    echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
}


?>