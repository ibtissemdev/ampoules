Projet Ampoule (Brief)


Un gardien de copropriété s'occupe de changer régulièrement les ampoules des communs de son immeuble de 11 étages.
Réaliser un Dashboard responsive dans lequel le gardien peut ajouter, modifier ou supprimer chaque changement d\'ampoule.

L\'application de base comportera :

une page qui liste l\'historique des changements d\'ampoules.
une page qui comportera le formulaire permettant d\'ajouter/modifier un changement d\'ampoule.
La suppression d\'un changement d\'ampoule se fera depuis la page qui liste l\'historique des changements d\'ampoules. Une boîte d\'alerte doit s\'afficher prévenant si la personne veut continuer ou annuler l\'action. Une fois la suppression terminée, afficher une alerte de type toasts qui indique que le changement d\'ampoule a bien été supprimé.



Le formulaire d\'ajout / modification doit comporter les champs suivants :

- La date du changement
- L\'étage ( rez-de-chaussée, étage1, étage2, étage3.....étage11)
- La position ( côté gauche, côté droit, fond)
- Le prix de l\'ampoule

Tous les champs du formulaire sont obligatoires et seront testés en HTML et PHP



Les +
Si le temps vous le permet vous pouvez ajouter un ou tous les points ci-dessous :

Une pagination de l\'historique
Une protection d\'accès aux pages par un formulaire de login et un lien de déconnexion

Projet Ampoule – suite

1-Créer une table ‘user’ contenant au moins les champs :
‘id’, ‘login’, ‘password’, ‘email’, ‘tel portable’
Le mot de passe doit être crypté en base (utiliser les fonctions natives PHP password_hash et password_verify)
2-Ajouter un lien ‘Mot de passe oublié ?’ et la page associée (cf. exemple plus bas). 
3-Ajouter un lien ‘Je n’ai pas de compte’ et la page associée (cf. exemple plus bas).
[Facultatif] Ajouter un captcha. Voir en fin de document pour le fonctionnement du captcha.
- Page de login 
- Récupération du mot de passe oublié 
- Page de création de compte 

En javascript, vérifier que les valeurs saisies dans les champs ‘Mot de passe’ et ‘Confirmez le mot de passe’ sont identiques.

4-Créer une table ‘message’ contenant au moins les champs :
‘id’, ‘message’, ‘author_id’, date

5-Modifier la table ‘historique’ et ajouter deux clés étrangères ‘user_id’ et ‘message_id’.
Lors de la validation du changement d’ampoule, ‘user_id’ reçoit l’id de l’utilisateur courant, ‘message_id’ reçoit l’identifiant du message éventuellement saisi par l’utilisateur.

6-Créer un champ de saisie ‘Recherche’. 
L’utilisateur saisi un mot clé et on affiche tous les messages contenant ce mot clé. La recherche se fera en ‘full text’ en utilisant la directive SQL ‘MATCH(…) AGAINST(…)’
On affichera le résultat de recherche sous la forme :
‘Date du message’
‘Texte du Message’ 
‘Auteur (login)’
‘Date de l’intervention’

Réaliser une requête SQL comprenant 2 jointures sur les tables ‘message’, ‘user’ et ‘historique’.

Fonctionnement du captcha :
    • Créer un nouveau fichier ‘captcha.php’
    • Dans ce fichier, créer une variable de SESSION dans laquelle on place un nombre aléatoire compris entre 10000 et 99999. Cette valeur sera à comparer avec la valeur saisie par l’utilisateur depuis le formulaire de login.
    • Créer un objet image au moyen de la fonction imagecreate()
    • Associer 2 couleurs à cette image (fonction imagecolorallocate())
    • Afficher le nombre aléatoire dans l’image au moyen de la fonction imagestring en passant en paramètre l’une des couleurs définies ci-dessus (l’autre couleur est la couleur de fond).
    • Créer l’image jpeg à partir de l’objet image au moyen de la fonction ‘imagejpeg’

MON PROJET AMPOULE

Ma page d'index nous envoie vers le formulaire de connexion (Identification), si nous ne sommes pas connectés.
Sur le formulaire d'Identification, il y a :
- Un lien "Mot de passe oublié" qui nous permet de modifier son mot de passe si l'on entre l'email et le numéro de téléphone qui correspondent. On doit confirmer le mot de passe saisi dans le champ précédent (vérification avec js et onblur).
- un Captcha image qui affiche un nombre aléatoire à sairir dans le champ, s'il n'est pas bon, la connexion ne se fait pas et un message s'affiche.
- un lien pour se créer un compte (avec un captcha et une confirmation de mot de passe)
Les mots de passes sont enregistrés dans la bdd avec un encryptage grâce à la fonction password_hash()

Une fois la connexion établie nous accédons à un Dashboard qui liste tous les changements, pour chaque changement nous avons la possibilité de supprimer, modifier ou ajouter un message.
Pour la fonction supprimer, une boîte d'alerte s'affiche pour confirmer ou non la suppression (avec js), si on confirme, le changement est supprimé et un toast s'affiche, le mien s'affiche, il affichait bien le message mais là il n'affiche plus qu'une fenêtre blanche.

Nous avons la possibilité de nous déconnecter, ce qui nous renvoie à la page d'Identification

Mon retour sur ce projet : 

    J'ai appris à gérer une connexion dans sa globalité (formulaire de connexion avec vérification, récupération de mot de passe, inscription, captcha)
    J'ai découvert la fonction de recherche avec fulltext, match() et against(), je l'ai trouvé simple d'utilisation. J'ai fais des jointures entre trois tables. 
    J'avais encore du mal à faire la différence entre les $_GET et $_POST. Je n'ai plus de difficulté à afficher des pages dynamiques selon les Id. J'avais aussi du mal à insérer des clés étrangères. Ce projet m'a donc permis d'aborder tous ces sujets et je serais capable de les réutiliser sur d'autres projets. 

