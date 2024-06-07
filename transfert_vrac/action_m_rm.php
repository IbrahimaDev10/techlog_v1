<?php 
//page action.php

require('../database.php');
$espace="";

if(isset($_POST['query'])){
	$search=$_POST['query'];
	$requete=$bdd->prepare('SELECT c.*,tr.* FROM camions as c
          inner join transporteur as tr on c.id_trans=tr.id where c.num_camions like ?');
	$requete->bindValue(1,"%$search%",PDO::PARAM_STR);
	$requete->execute();

	while($row=$requete->fetch()){
		?>
		 <a style="color: black;" id="<?php echo $row['id_camions']; ?>" onclick="stockerIds_m_rm(this)"> <span id="<?php echo "n_camions_m_rm" .$row['id_camions']; ?>"><?php echo $row['num_camions']; ?></span> <span id="<?php echo "transp_r_rm" .$row['id_camions']; ?>" style="color: blue;" hidden="true"> Transporteur: <?php echo $row['nom']; ?></span> </a><br>
	 
	<?php   }

}


 ?>


