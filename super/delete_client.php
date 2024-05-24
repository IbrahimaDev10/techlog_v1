<?php
require('../database.php');
$id = $_POST['delete_id'];

  



$supprimerDemande=$bdd->prepare('delete from client where id=?');
$supprimerDemande->bindParam(1, $id);
 $supprimerDemande->execute();
 header('location:gestion_donnees.php');

'<style>
#calclient{
	display:table;
}

</style>'


 
 
?>