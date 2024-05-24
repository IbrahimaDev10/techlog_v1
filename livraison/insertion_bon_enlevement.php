<?php 	
require("../database.php");

if(isset($_POST['date'])){

	$date=$_POST['date'];
	$num=$_POST['num'];
	
	$id_dis=$_POST['id_dis'];
	$navire=$_POST['navire'];
	$poids=$_POST['poids'];
	$insert=$bdd->prepare("INSERT INTO bon_enlevement(date_enleve,num_enleve,poids_enleve,id_dis_enleve,id_navire_enleve) VALUES(?,?,?,?,?)");
	$insert->bindParam(1,$date);
	$insert->bindParam(2,$num);
	$insert->bindParam(3,$poids);
	
	$insert->bindParam(4,$id_dis);
	$insert->bindParam(5,$navire);
	$insert->execute();

	echo "biennnnnnnnnnnn";


 ?>
 <?php } ?>