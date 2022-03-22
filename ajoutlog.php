<?php

require 'bdd.php';

$login="Ibtissem";
$password="DEcembre";

                $sth = $pdo->prepare("INSERT INTO user(Login,Password) VALUES (:Login,:Password)");
                //La constante de type par défaut est STR
                $sth->bindParam(':Login', $login);
                $sth->bindParam(':Password', $password);
                $sth->execute();
                echo "Entrée ajoutée dans la table";

?>