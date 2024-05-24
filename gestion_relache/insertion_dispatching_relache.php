<?php 
require('../database.php'); 
$explode_con=explode('-', $_POST['connaissement']);
$connaissement=$explode_con[1];
$id_relache=$explode_con[2]; //= ID_relache

$id_destination=$_POST['destination'];

$navire=$_POST['navire'];
$quantite=$_POST['quantite']; 





$insert=$bdd->prepare("INSERT INTO bon_relache(id_relache,id_bon_dispat,quantite_relache_init) values(?,?,?)");
$insert->bindParam(1,$id_relache);
$insert->bindParam(2,$id_destination);
$insert->bindParam(3,$quantite);

$insert->execute(); 
echo 'insertion reussi';

 
       ?>		