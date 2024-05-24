<?php 
require('../database.php'); 

$relache=$_POST['relache'];


$navire=$_POST['navire'];
$quantite=$_POST['quantite']; 

$date=$_POST['date']; 




$insert=$bdd->prepare("INSERT INTO remboursement(date_rembourser,quantite_rembourser,id_relache_rembourser) values(?,?,?)");
$insert->bindParam(1,$date);
$insert->bindParam(2,$quantite);

$insert->bindParam(3,$relache);

$insert->execute(); 
echo 'insertion reussi';

 
       ?>		