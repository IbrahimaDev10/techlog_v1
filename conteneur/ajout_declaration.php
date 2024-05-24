<?php 
require("../database.php");
if(!empty($_POST['num_dec']) and !empty($_POST['poids']) and !empty($_POST['con'])){
	$num_dec=$_POST['num_dec'];
	$poids=$_POST['poids'];
	$con=$_POST['con'];
	$insert=$bdd->prepare("INSERT INTO declaration_connaissement(num_declare,poids_declare,id_connaissement) values(?,?,?)");
	$insert->bindParam(1,$num_dec);
	$insert->bindParam(2,$poids);
	$insert->bindParam(3,$con);
	$insert->execute();
 ?>
 <div style="background: white;"><p>Declaration ajouté avec success</p></div>

<?php } ?>
