<?php 
//page action.php

require('../database.php');
$espace="";

if(isset($_POST['search'])){
	$search=$_POST['search'];
	$num=$_POST['num'];

	function afficher_bl($bdd,$search,$num){
	$requete=$bdd->prepare('SELECT id_num_conteneur,num_conteneur,poids_kg from numero_conteneur  where num_conteneur like ? and id_connaissement_conteneur=?');
	$requete->bindValue(1,"%$search%",PDO::PARAM_STR);
	$requete->bindParam(2,$num);
	$requete->execute();
	return $requete;
    }
?>
<center><h6 style="color:white !important;">choisissez un numero de conteneur</h6></center>
<?php 
       $requete=afficher_bl($bdd,$search,$num);	 
	while($row=$requete->fetch()){
		?>
		<center>	
		 <a style="color: white !important;" id="<?php echo $row['id_num_conteneur']; ?>" data-role="stocker_input" data-id="<?php echo $row['id_num_conteneur']; ?>"><span id=<?php echo $row['id_num_conteneur'].'num_conteneur'; ?> > <?php echo $row['num_conteneur'];?></span>
		 	<span style="display: none;" id=<?php echo $row['id_num_conteneur'].'poids_kg'; ?> > <?php echo $row['poids_kg'];?></span></a><br>	
		 	</center>
	 
	<?php   }

}


 ?>


