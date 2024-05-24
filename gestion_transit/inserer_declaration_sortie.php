<?php require('../database.php');

if(isset($_POST['navire'])){
	
	$dates=$_POST['dates'];
	$poids_dec=$_POST['poids_dec'];
	$num_dec=$_POST['num_dec'];
	$dec_entrant=$_POST['dec_entrant'];
	$navire=$_POST['navire'];
	$insert=$bdd->prepare('INSERT INTO declaration_sortie(date_decliv,num_decliv,poids_decliv,id_dec_entrant) VALUES(?,?,?,?)');
	$insert->bindParam(1,$dates);
	$insert->bindParam(2,$num_dec);
	$insert->bindParam(3,$poids_dec);
	$insert->bindParam(4,$dec_entrant);
	$insert->execute();
	echo "dihhhhhhhhhhhhhhhhhhhhhhhhhhhh";
} ?>
