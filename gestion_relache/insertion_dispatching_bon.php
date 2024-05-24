<?php 
require('../database.php'); 
$explode_con=explode('-', $_POST['connaissement']);
$connaissement=$explode_con[0];
$id_relache=$explode_con[2];

$id_destination=$_POST['destination'];

$navire=$_POST['navire'];
$quantite=$_POST['quantite']; 
$date=$_POST['date'];





$insert=$bdd->prepare("INSERT INTO bon_dispat(dates,id_bon,id_dis,quantite) values(?,?,?,?)");
$insert->bindParam(1,$date);
$insert->bindParam(2,$connaissement);
$insert->bindParam(3,$id_destination);
$insert->bindParam(4,$quantite);

$insert->execute(); 
echo 'insertion reussi';

 
       ?>		