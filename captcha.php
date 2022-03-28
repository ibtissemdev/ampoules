<?php
require 'bdd.php'; 


$_SESSION['captcha']= random_int(10000, 99999);

$img=imagecreate(60, 30);
$background= imagecolorallocate($img,0, 0, 255); // couleur de fond rouge
//$white=imagecolorallocate($img,255,255,255);
//$black=imagecolorallocate($img,0,0,0);
$textcolor=imagecolorallocate($img, 255, 255, 255);

imagestring($img,5,6,6,$_SESSION['captcha'],$textcolor);

/*imagefilledrectangle($img,0,0,70,30,$fill_color); // dessiner un rectangle 0,0 : commence le rectangle au coin supérieur gauche, 70 et 30 : taille de notre image

$text_color=imagecolorallocate($img,10,10,10); //stocker une couleur sur l'image, les 3 chiffres sont les couleurs rvb

imagettftext($img,23,0,5,20,$text_color,$font,$_SESSION['captcha']);
//fonction qui permet d'écrire du texte sur une image, img, taille de la font, 0: pour pencher le texte, 5:position du premier caractère(le coin bas gauche du caractère à 5px du bord), 30: ligne de base de notre police. On stock tout dans $_SESSION*/

header("Content-Type:image/jpeg"); //nous voulons afficher notre image dans notre navigateur
imagejpeg($img,null); // envoyer l'image vers le navigateur
imagedestroy($img); //libère toute la mémoire associée à l'image


?>