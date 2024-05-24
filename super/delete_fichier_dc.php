<?php
require('../database.php');
$id = $_POST['delete_id'];



$supprimerDemande=$bdd->prepare('delete from fichier_declaration_chargement where id_fich_dc=?');
$supprimerDemande->bindParam(1, $id);
 $supprimerDemande->execute();


 
 
?>