<?php 

function client($bdd){
	$client=$bdd->query("select client, id from client");
	return $client;
}
function connaissement($bdd){
	$connaissement=$bdd->query("SELECT id_bl, n_bl from connaissement_conteneur");
	return $connaissement;
}
function mangasin($bdd,$session){
	$mangasin=$bdd->prepare("select mangasin, id from mangasin where id_mangasinier=?");
	$mangasin->bindParam(1,$session);
	$mangasin->execute();

	return $mangasin;
}

$inf=0;

if(isset($_POST['ajouter_conteneur'])){
	if(!empty($_POST['bl']) and !empty($_POST['compagnie']) and !empty($_POST['dates'])){
		$bl=$_POST['bl'];
		$compagnie=$_POST['compagnie'];
		$dates=$_POST['dates'];
		$navire=$_POST['navire'];
		$chargeur=$_POST['chargeur'];
		$consigne=$_POST['consignation'];
		$client=$_POST['client'];
		$port=$_POST['port'];
		$destination=$_POST['destination'];

$insert=$bdd->prepare("INSERT INTO connaissement_conteneur(n_bl,compagni,chargeur,consigne,id_client,navire,port_charger,id_destination,dates) values(?,?,?,?,?,?,?,?,?)");
$insert->bindParam(1,$bl);	
$insert->bindParam(2,$compagnie);	
$insert->bindParam(3,$chargeur);	
$insert->bindParam(4,$consigne);
$insert->bindParam(5,$client);	
$insert->bindParam(6,$navire);	
$insert->bindParam(7,$port);	
$insert->bindParam(8,$destination);
$insert->bindParam(9,$dates);
$insert->execute();			

  $_SESSION['infos']=$bl;
	header("location:ajout_numero_conteneur.php");
}
else { 

	$inf="VEUILLEZ COMPLETER LES CHAMPS";
       
     
}
}
?>
