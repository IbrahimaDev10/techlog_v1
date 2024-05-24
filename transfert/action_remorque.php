<?php 
//page action.php

require('../database.php');
$espace="";

if(!empty($_POST['query'])){
	$search=$_POST['query'];
	$requete=$bdd->prepare('SELECT * FROM remorque where num_remorque like ?');
	$requete->bindValue(1,"%$search%",PDO::PARAM_STR);
	$requete->execute();

	while($row=$requete->fetch()){
		?>
		 <a id="<?php echo $row['id_remorque']; ?>" onclick="stockerIdRemorque(this)"> <span id="<?php echo "num_remorque" .$row['id_remorque']; ?>"><?php echo $row['num_remorque']; ?></span> <span id="<?php echo "transpR" .$row['id_remorque']; ?>" style="color: blue;" hidden="true"> Transporteur: </span> </a><br>
	 
	<?php   }

}


 ?>


