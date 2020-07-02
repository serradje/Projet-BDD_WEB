
<?php

//Création des variables
$PARAM_hote="localhost"; // le chemin vers le serveur
$PARAM_nom_bd="sitewebshop"; // le nom de votre base de données
$PARAM_utilisateur="root"; // nom d'utilisateur pour se connecter au serveur
$PARAM_mdp=""; // mot de passe de l'utilisateur pour se connecter
//Création de la connexion
try
{
$connexion = new PDO('mysql:host='.$PARAM_hote.';
dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mdp);

}
//gestion des erreurs
catch(Exception $e)
{
echo 'Erreur : '.$e->getMessage().'<br />';
echo 'N° : '.$e->getCode();

}
  ?>