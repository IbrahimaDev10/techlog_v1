<?php
require('../database.php');
$id = $_POST['delete_id'];

  



$supprimerDemande=$bdd->prepare('delete from camions where id_camions=?');
$supprimerDemande->bindParam(1, $id);
 $supprimerDemande->execute();


 
 
?>