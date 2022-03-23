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
  <h1>Récupération mot de passe</h1>
<form class="row g-3" action="" method="post" name="form" id="form" >
            

            <div class="col-md-6">
              <label for="Email" class="form-label">Email</label>
              <input type="email"  class="form-control" name="Email" id="Email" placeholder="Entrer l'email" required>
            </div>

            <div class="col-md-6">
              <label for="Telephone" class="form-label">Telephone</label>
              <input type="tel"  maxlength="10" class="form-control" name="Tel" id="Telephone" placeholder="Entrer le numéro de téléphone" required>
            </div>
          
            <div class="col-md-6">
              <label for="motdepasse" class="form-label">Mot de passe</label>
              <input type="password" requierd pattern="^[A-Za-z '-]+$"  maxlength="20" class="form-control" name="Password" id="password"  placeholder="Entrer le mot de passe" required>
            </div>

            <div class="col-md-6">
              <label for="motdepasse" class="form-label">Confirmer le mot de passe</label>
              <input type="password" requierd pattern="^[A-Za-z '-]+$"  maxlength="20"  class="form-control" name="passwordconf" onblur="verif()"  id="passwordconf" placeholder="Confirmer votre mot de passe" required>
              
            </div>
           
            <div class="col-md-6">
            <input type="submit" name='submit' id='submit' value='Envoyer'>
            </div>
         



          </form>
          </div>
<?php

require 'bdd.php' ;

if (isset($_POST['Email']) && $_POST['Tel']){
    error_log("post :".print_r($_POST, 1));
    //$util="SELECT * FROM user WHERE Email=':email' ";//AND Tel=':tel'

    $util="SELECT * FROM user WHERE Email='".$_POST['Email']."' AND Tel='".$_POST['Tel']."'";
    error_log($util);
    $sth=$pdo->prepare($util);
    $sth->bindParam(':email', $_POST['Email'], PDO::PARAM_STR);
    $sth->bindParam(':tel', $_POST['Tel'], PDO::PARAM_STR);
    $sth->execute();
    $result = $sth->fetch();
    error_log("Result : ".print_r($result, 1));
        if($_POST['Email']==$result['Email'] && $_POST['Tel']==$result['Tel']) {
$_POST['Password']=password_hash($_POST['Password'],PASSWORD_DEFAULT);
            $sth = $pdo->prepare("UPDATE user SET Password=:Password WHERE Email='". $_POST['Email']."'");
            $sth->bindParam(':Password', $_POST['Password']);
          $sth->execute();
        }else {

            echo "Email ou téléphone inconnu";
    
    }}
          //MODIFIER
  /*$colonne = $_POST;
  
  unset($colonne['submit'] );
  unset ($colonne['passwordconf']);
 
  error_log(print_r($colonne, 1));
  $colonneName = array_keys($colonne);

  error_log(print_r($colonneName, 1)) ;

  foreach ($colonneName as $colonneName2) {
    $result[] = $colonneName2 . "=:" . $colonneName2;
  }
  $colonne1 = implode(",", $result);*/

  //$sth = $pdo->prepare("UPDATE user SET $colonne1 WHERE Email=:email");


 /* foreach ($colonne as $key => &$value) {
    $sth->bindParam(':' . $key, $value);
  }
  $sth->execute();

} else {

    echo "Email ou téléphone inconnu";
}*/


?>
          
          <script src="script.js"> </script>
</body>
</html>
