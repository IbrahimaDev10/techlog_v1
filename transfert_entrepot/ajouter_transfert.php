<?php 
require('../database.php');
if(!empty($_POST['quantite']) and !empty($_POST['destination']) and !empty($_POST['connaissement']) ){
	
	$connaissement=$_POST['connaissement'];
	$quantite=$_POST['quantite'];
	$destination=$_POST['destination'];
	$insert=$bdd->prepare("INSERT INTO transfert(poids_transfert,id_dis_transfert,id_nouvelle_destination) values(?,?,?)");
	$insert->bindParam(1,$quantite);
	$insert->bindParam(2,$connaissement);
	$insert->bindParam(3,$destination);
	$insert->execute();

	$update=$bdd->prepare("update dispat set demande_transfert=1 where id_dis=?
		");
	$update->bindParam(1,$connaissement);
	$update->execute();
echo "Votre ordre de transfert à été ajouté avec success";
} ?>