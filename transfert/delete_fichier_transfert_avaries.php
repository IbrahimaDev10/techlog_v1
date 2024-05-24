<?php 

require("../database.php");
$id=$_POST['delete_id'];
$delete=$bdd->prepare("DELETE from fichier_transfert where id_fich_trans=?");
$delete->bindParam(1,$id);
$delete->execute();
 ?>