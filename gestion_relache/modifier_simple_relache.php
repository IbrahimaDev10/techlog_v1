<?php 
require('../database.php');
 require('controller/afficher_navire.php');
if(!empty($_POST['date']) and !empty($_POST['quantite']) and !empty($_POST['num_relache']) and !empty($_POST['id']) ){
	$quantite=$_POST['quantite'];
	$num_relache=$_POST['num_relache'];
	$id=$_POST['id'];
	$navire=$_POST['navire'];
	$date=$_POST['date'];
	echo $num_relache;
	echo $quantite;
	echo $id;
	$update=$bdd->prepare('UPDATE numero_relache set num_relache=? , quantite=?, date_relache=? WHERE id_relache=?');
	$update->bindParam(1,$num_relache);
	$update->bindParam(2,$quantite);
	$update->bindParam(3,$date);
	$update->bindParam(4,$id);
	$update->execute();
     	
 ?>

<div class="container-fluid" id="tableau_modifier_relache" >
  <?php affichage_tableau_modifier_relache($bdd,$navire); ?>
</div>


<?php } ?>

