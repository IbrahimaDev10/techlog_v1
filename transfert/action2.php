<?php 
//page action.php

require('../database.php');
$espace="";

if(isset($_POST['querys'])){
	$search=$_POST['querys'];
	$requete=$bdd->prepare('SELECT c.*,tr.* FROM camions as c
          inner join transporteur as tr on c.id_trans=tr.id where c.num_camions like ?');
	$requete->bindValue(1,"%$search%",PDO::PARAM_STR);
	$requete->execute();

	while($row=$requete->fetch()){
		?>
		 <a>  <?php echo $row["num_camions"] ?> </a><br>
	 
	<?php   }

}


 ?>



 