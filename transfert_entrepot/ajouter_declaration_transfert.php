<?php 
require('../database.php');
if(!empty($_POST['quantite']) and !empty($_POST['connaissement']) and !empty($_POST['num_dec']) ){
	
	$connaissement=$_POST['connaissement'];
	$quantite=$_POST['quantite'];
	$num_dec=$_POST['num_dec'];
	$a="zzz";
	$insert=$bdd->prepare("INSERT INTO declaration_transfert(num_dec_transfert,n_manifeste,destination_douaniere,poids_declarer_transfert,id_bl_transfert) values(?,?,?,?,?)");
	$insert->bindParam(1,$num_dec);
	$insert->bindParam(2,$a);
	$insert->bindParam(3,$a);
	$insert->bindParam(4,$quantite);
	$insert->bindParam(5,$connaissement);
	
	$insert->execute();

	/*$update=$bdd->prepare("update dispat set demande_transfert=1 where id_dis=?
		");
	$update->bindParam(1,$connaissement);
	$update->execute(); */
echo "Votre declaration à été ajouté avec success";
} ?>