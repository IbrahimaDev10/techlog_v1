<?php 
 require('../../../database.php');
 require('../../controller/afficher_liste_camion.php');


$navire=$_POST['navire'];

$ticket=$_POST['ticket'];
$poids_brut=$_POST['poids_brut'];
$id_tare=$_POST['id_tare'];
$tare_vehicule=$_POST['tare_vehicule'];
$id=$_POST['id'];
$dates=$_POST['dates'];
$sac=$_POST['sac'];
$tare_sac=$_POST['tare_sac'];
  $net_pont_bascule=$poids_brut-$tare_vehicule;

    if($sac==0){
    	$tare_sac=0;
    	$id_tare=0;
    }    
    
    $net_marchand=$net_pont_bascule/1000-$sac*$tare_sac/1000;
     

$insert=$bdd->prepare("INSERT INTO pont_bascule(ticket_ponts,poids_bruts,tare_vehicules,id_transfert,id_tare_sac,poids_net,date_pont) values(?,?,?,?,?,?,?) ");
$insert->bindParam(1,$ticket);
$insert->bindParam(2,$poids_brut);
$insert->bindParam(3,$tare_vehicule);
$insert->bindParam(4,$id);
$insert->bindParam(5,$id_tare);
$insert->bindParam(6,$net_marchand);
$insert->bindParam(7,$dates);
$insert->execute();

$update=$bdd->prepare("UPDATE transfert_debarquement set etat_pont='oui' where id_register_manif=? ");

$update->bindParam(1,$id);
$update->execute();




affichage_liste_camion($bdd,$navire); ?>


