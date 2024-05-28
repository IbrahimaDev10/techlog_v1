<?php 
require('../../database.php');
require('../controller/afficher_liste_camion.php');

$navire=$_POST['navire'];


affichage_liste_camion($bdd,$navire); ?>


