<?php 
require('../../database.php');

$tr=$_POST['transporteur'];
if( !empty($tr)){
	$select=$bdd->prepare('SELECT * from transporteur where nom=?');
	$select->bindParam(1,$tr);
	$select->execute();
	
	if($sel=$select->fetch()){ ?>
		<div class="alert alert-danger" id="message_add_camion">Ce transporteur existe déja </div>
		<?php 

	
	}
	else{
		$insert=$bdd->prepare('INSERT INTO transporteur (nom) values(?)');
   
    $insert->bindParam(1,$tr);
    $insert->execute();	?>
    <div class="alert alert-success" id="message_add_camion"><center> Transporteur ajouté avec success <span class="fa fa-check-circle"></span></center></div>
    <?php  
	}

}
else{ ?>
	<div class="alert alert-danger" id="message_add_transporteur">Veuillez remplir les champs</div>
	<?php 
}




 ?>
