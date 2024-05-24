<?php 
//page action.php

require('../database.php');
$espace="";

if(!empty($_POST['query'])){
	$search=$_POST['query'];
	$requete=$bdd->prepare('SELECT * from chauffeur where nom_chauffeur like ?');
	$requete->bindValue(1,"%$search%",PDO::PARAM_STR);
	$requete->execute();

	while($row=$requete->fetch()){
		?>
		<span style="float: left; ">
    <a style="color: black;"  class="camionc" id="<?php echo $row['id_chauffeur']; ?>" onclick="stockerIdc(this)"><?php echo $row['nom_chauffeur']; ?>   <span style="color: blue;">permis: <?php echo $row['n_permis']; ?> Tel:<?php echo $row['num_telephone']; ?></span></a></span><br>
	 
	<?php   }

}


 ?>


