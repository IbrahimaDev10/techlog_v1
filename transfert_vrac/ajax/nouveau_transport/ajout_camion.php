<?php 
require('../../../database.php');
$camion=$_POST['camion'];
$tr=$_POST['transporteur'];
if(!empty($camion) and !empty($tr)){
	$select=$bdd->prepare('SELECT * from camions where num_camions=?');
	$select->bindParam(1,$camion);
	$select->execute();
	
	if($sel=$select->fetch()){ ?>
		<div class="alert alert-danger" id="message_add_camion" style="display: block;">Ce numero de camion existe déja </div>
		<?php 

	
	}
	else{
		$insert=$bdd->prepare('INSERT INTO camions (num_camions,id_trans) values(?,?)');
    $insert->bindParam(1,$camion);
    $insert->bindParam(2,$tr);
    $insert->execute();	?>
    <div class="alert alert-success" id="message_add_camion" style="display: block;"><center> Camion ajouté avec success <span class="fa fa-check-circle"></span></center></div>
    <?php  
	}

}
else{ ?>
	<div class="alert alert-danger" id="message_add_camion" style="display: block;">Veuillez remplir les champs</div>
	<?php 
}




 ?>
