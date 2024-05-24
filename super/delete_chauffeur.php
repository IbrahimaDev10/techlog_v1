<?php
require('../database.php');
$id = $_POST['delete_id'];

  



$supprimerDemande=$bdd->prepare('delete from chauffeur where id_chauffeur=?');
$supprimerDemande->bindParam(1, $id);
 $supprimerDemande->execute();


 
 
?>