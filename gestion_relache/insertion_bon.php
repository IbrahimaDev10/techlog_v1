<?php 
require('../database.php'); 

if(!empty($_POST['quantite']) and !empty($_POST['date']) and !empty($_POST['id_dis']) and !empty($_POST['numero']) and !empty($_POST['destinataire']) and !empty($_POST['navire']) ){
$quantite=$_POST['quantite']; 
$numero=$_POST['numero'];  
$date=$_POST['date']; 
$client=$_POST['id_dis'];
//$destination=$_POST['destination'];
$destinataire=$_POST['destinataire'];
$navire=$_POST['navire'];




$insert=$bdd->prepare("INSERT INTO bon(dates,numero_bon,quantite,client_id,navire_id,destinataire) values(?,?,?,?,?,?)");
$insert->bindParam(1,$date);
$insert->bindParam(2,$numero);
$insert->bindParam(3,$quantite);
$insert->bindParam(4,$client);
$insert->bindParam(5,$navire);
$insert->bindParam(6,$destinataire);

$insert->execute(); 

echo "<center><div class='alert alert-success'> <h3>INSERTION REUSSI AVEC SUCCESS</h3></div></center>";

}
else{
echo "<center><div class='alert alert-danger'> <h3>VEUILLEZ SAISIR TOUS LES CHAMPS</h3></div></center>";	
}

 
       ?>		