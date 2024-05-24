<?php 
require('../database.php'); 
$explode_con=explode('-', $_POST['connaissement']);
$connaissement=$explode_con[1]; //=banque
//$id_dis=$explode_con[2];
$explode=explode('-', $_POST['produit']);
$id_produit=$explode[0]; // =ID_PRODUIT
$poids_sac=$explode[1]; //=POIDS_SAC
$navire=$_POST['navire'];
$quantite=$_POST['quantite']; 
$numero=$_POST['numero'];  
$date=$_POST['date']; 
$statut=$_POST['statut']; 



$insert=$bdd->prepare("INSERT INTO relaches(dates,numero_relache,quantite,produit_id,poids_sac,banque_id,navire_id) values(?,?,?,?,?,?,?)");
$insert->bindParam(1,$date);
$insert->bindParam(2,$numero);
$insert->bindParam(3,$quantite);
$insert->bindParam(4,$id_produit);
$insert->bindParam(5,$poids_sac);
$insert->bindParam(6,$connaissement);
$insert->bindParam(7,$navire);

$insert->execute(); 
echo 'insertion reussi';

 
       ?>		