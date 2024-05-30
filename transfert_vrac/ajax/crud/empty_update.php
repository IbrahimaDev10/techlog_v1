<?php 
 require('../../../database.php');
 require('../../controller/afficher_les_debarquements.php');
 //require('controller/control_excedent_sur_declaration.php');
 //require('controller/afficher_les_filtres.php');
    // code...
      
 

$poids_sac= $_POST['poids_sac'];

$update=$bdd->prepare("UPDATE  transfert_debarquement set empty_poids_sac=? where poids_sac=? ");
$update->bindParam(1,$poids_sac);
$update->bindParam(2,$poids_sac);
$update->execute();


?> 


 

