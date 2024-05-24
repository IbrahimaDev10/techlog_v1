<?php require('../database.php');
$connaissement=$_POST['connaissement'];

$query=$bdd->prepare('SELECT poids_kg from numero_connaissements where id_connaissement=? ');
$query->bindParam(1,$connaissement);
$query->execute();

$qr=$query->fetch();

 ?>
 <input type="text" name='poids_sc2' id="poids_scon" value="<?php echo $qr['poids_kg']; ?>">	

