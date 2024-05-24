<?php require('../../database.php'); 
    $idm=$_POST['id_navire'];
	if(!empty($_POST['relache']) and !empty($_POST['date_bon']) and !empty($_POST['quantite_bon']) and !empty($_POST['numero_bon']) ){
		//$nav=$_POST['navire'];
		
		$relache=$_POST['relache'];
		$date_bon=$_POST['date_bon'];
		$quantite_bon=$_POST['quantite_bon'];
		
		$numero_bon=$_POST['numero_bon'];

 
			 $insertRelache= $bdd->prepare("INSERT INTO bon_debarquement(date_bon,num_bon,quantite_bon,relache_id) VALUES(?,?,?,?)");
			 try{

		 $insertRelache->bindParam(1,$date_bon);
		 $insertRelache->bindParam(2,$numero_bon);
		 $insertRelache->bindParam(3,$quantite_bon);
		 $insertRelache->bindParam(4,$relache);


		$insertRelache->execute();

		

	
	}
	catch(Exception $e){

	}
	   echo '<div class="alert alert-success" >AJOUT REUSSI<i class="fas fa-close" style="float:right;"  aria-label="Close"></i></div>';
	 

	}

	else{
		  echo '<div class="alert alert-danger" >ERREUR VEUILLEZ ASSURES QUE TOUS LES CHAMPS ONT BIEN ETE SAISI<i class="fas fa-close" style="float:right;"  aria-label="Close"></i></div>';
	}

	


$afficher=$bdd->prepare("select dc.*, p.* from declaration_chargement as dc 
	inner join produit_deb as p on dc.id_produit=p.id

  where dc.id_navire=?");
$afficher->bindParam(1,$idm);
$afficher->execute();

?>

	 <div  class="table-responsive" border=1 id='donnees_cale'>
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
 	<thead>
 		<td colspan="6" style="background: rgb(0,141,202); color: white; text-align:center;">DONNEES DEJA INSEREES</td>
 	<tr style="background: rgb(0,141,202); color: white; text-align:center;">
 	<th>cale</th>
 	<th>produit</th>
 	<th>sac</th>
 	<th>poids_sac</th>
 	<th>tonnage</th>
 	<th>nom_chargeur</th>
 </tr>
 	
 	</thead>

 <?php while($aff=$afficher->fetch()){?>
 	<tr style="background: white; color: black; text-align: center; vertical-align: middle;">
<td ><?php echo $aff['cales'] ?></td>
<td ><?php echo $aff['produit'] ?></td>
<td ><?php echo $aff['nombre_sac'] ?></td>
<td ><?php echo $aff['conditionnement'] ?></td>
<td ><?php echo $aff['poids'] ?></td>
<td ><?php echo $aff['nom_chargeur'] ?></td>

 </tr>
 <?php } ?> 

	

 	</tr>
</table>
</div>


