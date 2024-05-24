<?php 
require('../../database.php');
$chauffeur=$_POST['chauffeur'];
$tel=$_POST['tel'];
$permis=$_POST['permis'];
if(!empty($chauffeur) and !empty($permis) and !empty($tel)){
	$select=$bdd->prepare('SELECT * from chauffeur where nom_chauffeur=? and n_permis=? and num_telephone=?');
	$select->bindParam(1,$chauffeur);
	$select->bindParam(2,$permis);
	$select->bindParam(3,$tel);
	$select->execute();
	
	if($sel=$select->fetch()){ ?>
		<div class="alert alert-danger" id="message_add_chauffeur">Ce chauffeur existe déja </div>
		<?php 

	
	}
	else{
		$insert=$bdd->prepare('INSERT INTO chauffeur (nom_chauffeur,n_permis,num_telephone) values(?,?,?)');
    $insert->bindParam(1,$chauffeur);
    $insert->bindParam(2,$permis);
    $insert->bindParam(3,$tel);
    $insert->execute();	?>
    <div class="alert alert-success" id="message_add_camion"><center> Chauffeur ajouté avec success <span class="fa fa-check-circle"></span></center></div>
    <?php  
	}

}
else{ ?>
	<div class="alert alert-danger" id="message_add_camion">Veuillez remplir les champs</div>
	<?php 
}




 ?>
