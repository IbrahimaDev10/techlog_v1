<?php 
require('../database.php');
require('controller/afficher_navire.php');
$id_relache=$_POST['id'];
$num_relache=$_POST['num_relache'];
$qt_reelle=$_POST['quantite_reelle'];
$qt_transfert=$_POST['quantite_transfert'];
$id_dis=$_POST['id_nouvel_id_dis'];
$date=$_POST['date'];
$navire=$_POST['navire'];
$id_con_dis=$_POST['id_con_dis'];
$statut=0;

$qt_update=$qt_reelle-$qt_transfert;

$insert=$bdd->prepare("INSERT INTO numero_relache(date_relache,num_relache,quantite,id_connaissement,status,id_dis_relache) values(?,?,?,?,?,?)");
$insert->bindParam(1,$date);
$insert->bindParam(2,$num_relache);
$insert->bindParam(3,$qt_transfert);
$insert->bindParam(4,$id_con_dis);
$insert->bindParam(5,$statut);
$insert->bindParam(6,$id_dis);
$insert->execute(); 
$update=$bdd->prepare('UPDATE numero_relache set quantite=? WHERE id_relache=?');
$update->bindParam(1,$qt_update);
$update->bindParam(2,$id_relache);
$update->execute();

echo 'insertion reussi'; 

?>
<div class="container-fluid" id="tableau_modifier_relache" >
  <?php affichage_tableau_modifier_relache($bdd,$navire); ?>
</div>

 

