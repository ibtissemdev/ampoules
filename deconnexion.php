<?php
session_start();




// remove all session variables
session_unset();

// destroy the session
session_destroy();


    header("location:connexion.php");
    // echo "Identifiant ou mot de passe incorrect";





?>

